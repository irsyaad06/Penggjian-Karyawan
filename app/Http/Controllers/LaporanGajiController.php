<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlipGaji;
use App\Models\LaporanGaji;
use Carbon\Carbon;

class LaporanGajiController extends Controller
{
    public function index()
    {
        $laporan = LaporanGaji::orderBy('periode', 'desc')->get();
        return view('laporan_gaji.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporan_gaji.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|date_format:Y-m',
        ]);

        // Cek apakah laporan sudah ada
        if (LaporanGaji::where('periode', $request->periode)->exists()) {
            return redirect()->route('laporan-gaji.index')->with('error', 'Laporan Gaji untuk periode ini sudah ada!');
        }

        // Simpan laporan
        $laporan = new LaporanGaji();
        $laporan->periode = $request->periode;
        $laporan->save();

        return redirect()->route('laporan-gaji.index')->with('success', 'Laporan Gaji berhasil dibuat!');
    }

    public function show($id)
    {
        $laporan = LaporanGaji::findOrFail($id);

        // Ambil slip gaji dalam periode yang sesuai
        $slipGaji = SlipGaji::whereMonth('tanggal_gajian', Carbon::parse($laporan->periode)->month)
                            ->whereYear('tanggal_gajian', Carbon::parse($laporan->periode)->year)
                            ->with('karyawan.jabatan')
                            ->get();

        return view('laporan_gaji.show', compact('laporan', 'slipGaji'));
    }
}
