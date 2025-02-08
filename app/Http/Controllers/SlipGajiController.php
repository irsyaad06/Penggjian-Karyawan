<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SlipGajiController extends Controller
{
    public function index()
    {
        $slipGaji = SlipGaji::with('karyawan')->orderBy('tanggal_gajian', 'desc')->get();
        return view('slip_gaji.index', compact('slipGaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('slip_gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
{
    $request->validate([
        'karyawan_id' => 'required|exists:karyawan,id',
        'tanggal_gajian' => 'required|date',
    ]);

    $karyawan = Karyawan::with('jabatan')->findOrFail($request->karyawan_id);

    // Ambil data dari Jabatan
    $gajiPokok = $karyawan->jabatan->gaji_pokok;
    $tunjangan = $karyawan->jabatan->tunjangan ?? 0;
    $pajak = 50000; // Contoh pajak tetap
    $potonganBpjs = $gajiPokok * 0.05; // 5% dari gaji pokok sebagai BPJS
    $gajiBersih = ($gajiPokok + $tunjangan) - ($pajak + $potonganBpjs);

    // Simpan data ke database
    SlipGaji::create([
        'karyawan_id' => $request->karyawan_id,
        'gaji_bersih' => $gajiBersih,
        'pajak' => $pajak,
        'potongan_bpjs' => $potonganBpjs,
        'tanggal_gajian' => $request->tanggal_gajian,
    ]);

    return redirect()->route('slip-gaji.index')->with('success', 'Slip Gaji berhasil ditambahkan!');
}


    public function destroy($id)
    {
        SlipGaji::destroy($id);
        return redirect()->route('slip-gaji.index')->with('success', 'Slip Gaji berhasil dihapus!');
    }

    public function generatePDF($id)
    {
        $slip = SlipGaji::with(['karyawan.jabatan'])->findOrFail($id);
    
        // Debugging: Cek apakah data benar-benar ada
        if (!$slip) {
            abort(404, 'Slip Gaji tidak ditemukan');
        }
    
        // Pastikan gaji_pokok dan tunjangan ada
        $gajiPokok = $slip->karyawan->jabatan->gaji_pokok ?? 0;
        $tunjangan = $slip->karyawan->jabatan->tunjangan ?? 0;
    
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('slip_gaji.pdf', compact('slip', 'gajiPokok', 'tunjangan'));
        return $pdf->download('Slip_Gaji_'.$slip->karyawan->nama.'.pdf');
    }
    

    
}
