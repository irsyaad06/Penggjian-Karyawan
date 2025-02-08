<?php

namespace App\Http\Controllers;

use App\Models\PajakPenghasilan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PajakPenghasilanController extends Controller
{
    // Menampilkan daftar pajak penghasilan
    public function index()
    {
        $pajakPenghasilan = PajakPenghasilan::with('karyawan')->get(); // Ambil semua data pajak beserta data karyawan
        return view('pajak_penghasilan.index', compact('pajakPenghasilan'));
    }

    // Menampilkan form untuk menambah pajak penghasilan
    public function create()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan untuk dropdown
        return view('pajak_penghasilan.create', compact('karyawan'));
    }

    // Menyimpan data pajak penghasilan
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tahun' => 'required|integer',
            'bulan' => 'required|string',
            'jumlah_pajak' => 'required|numeric',
            'status_pembayaran' => 'required|in:belum_bayar,sudah_bayar',
        ]);

        PajakPenghasilan::create($request->all()); // Simpan data pajak penghasilan

        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data pajak penghasilan
    public function edit($id)
    {
        $pajak = PajakPenghasilan::findOrFail($id); // Cari data pajak berdasarkan ID
        $karyawan = Karyawan::all(); // Ambil semua data karyawan untuk dropdown
        return view('pajak_penghasilan.edit', compact('pajak', 'karyawan'));
    }

    // Memperbarui data pajak penghasilan
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:belum_bayar,sudah_bayar',
        ]);

        $pajak = PajakPenghasilan::findOrFail($id); // Cari data pajak berdasarkan ID
        $pajak->update($request->all()); // Update data pajak

        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil diperbarui!');
    }

    // Menghapus data pajak penghasilan
    public function destroy($id)
    {
        $pajak = PajakPenghasilan::findOrFail($id);
        $pajak->delete();

        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil dihapus!');
    }
}
