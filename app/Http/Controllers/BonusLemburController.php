<?php

namespace App\Http\Controllers;

use App\Models\BonusLembur;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class BonusLemburController extends Controller
{
    // Menampilkan daftar bonus dan lembur
    public function index()
    {
        $bonusLembur = BonusLembur::with('karyawan')->get(); // Mengambil data bonus dan lembur beserta data karyawan
        return view('bonus_lembur.index', compact('bonusLembur'));
    }

    // Menampilkan form untuk menambah bonus dan lembur
    public function create()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan untuk dropdown
        return view('bonus_lembur.create', compact('karyawan'));
    }

    // Menyimpan data bonus dan lembur
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'bonus' => 'required|numeric',
            'lembur' => 'required|numeric',
            'status_bayar' => 'required|in:belum_bayar,sudah_bayar',
        ]);

        BonusLembur::create($request->all()); // Simpan data bonus dan lembur

        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit data bonus dan lembur
    public function edit($id)
    {
        $bonusLembur = BonusLembur::findOrFail($id); // Cari data bonus dan lembur berdasarkan ID
        $karyawan = Karyawan::all(); // Ambil semua data karyawan untuk dropdown
        return view('bonus_lembur.edit', compact('bonusLembur', 'karyawan'));
    }

    // Memperbarui data bonus dan lembur
    public function update(Request $request, $id)
    {
        $request->validate([
            'status_bayar' => 'required|in:belum_bayar,sudah_bayar',
        ]);

        $bonusLembur = BonusLembur::findOrFail($id); // Cari data bonus dan lembur berdasarkan ID
        $bonusLembur->update($request->all()); // Update data bonus dan lembur

        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil diperbarui!');
    }

    // Menghapus data bonus dan lembur
    public function destroy($id)
    {
        $bonusLembur = BonusLembur::findOrFail($id);
        $bonusLembur->delete();

        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil dihapus!');
    }
}
