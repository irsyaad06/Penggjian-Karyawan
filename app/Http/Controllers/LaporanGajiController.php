<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlipGaji;
use App\Models\LaporanGaji;

class LaporanGajiController extends Controller
{
    public function index()
    {
        $laporan = LaporanGaji::all();
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

        // Ambil semua slip gaji dalam periode tersebut
        $laporan = new LaporanGaji();
        $laporan->periode = $request->periode;
        $laporan->save();

        return redirect()->route('laporan_gaji.index')->with('success', 'Laporan Gaji berhasil dibuat!');
    }

    public function show($id)
    {
        $laporan = LaporanGaji::findOrFail($id);
        $slipGaji = SlipGaji::whereMonth('tanggal_gajian', date('m', strtotime($laporan->periode)))
                            ->whereYear('tanggal_gajian', date('Y', strtotime($laporan->periode)))
                            ->with('karyawan')
                            ->get();

        return view('laporan_gaji.show', compact('laporan', 'slipGaji'));
    }
}
