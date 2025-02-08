<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class CutiController extends Controller
{
    public function index()
    {
        $cuti = Cuti::with('karyawan')->get();
        $karyawan = Karyawan::all();
        return view('cuti.index', compact('cuti', 'karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jenis_cuti' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        Cuti::create($request->all());

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $cuti = Cuti::findOrFail($id);
        return view('cuti.edit', compact('cuti'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $cuti = Cuti::findOrFail($id);
        $cuti->update($request->all());

        return redirect()->route('cuti.index')->with('success', 'Status cuti berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $cuti = Cuti::findOrFail($id);
        $cuti->delete();

        return redirect()->route('cuti.index')->with('success', 'Cuti berhasil dihapus!');
    }
}
