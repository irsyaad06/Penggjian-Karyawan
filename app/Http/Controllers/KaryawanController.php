<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\KaryawanImport;

class KaryawanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $karyawan = Karyawan::with('jabatan')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%$search%")
                    ->orWhereHas('jabatan', function ($q) use ($search) {
                        $q->where('nama_jabatan', 'like', "%$search%");
                    })
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('telepon', 'like', "%$search%");
            })
            ->get();

        return view('karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $jabatan = Jabatan::all();
        return view('karyawan.create', compact('jabatan'));
    }

    public function generateNIK(Request $request)
    {
        $tahun = date('Y');
        $jabatanNama = $request->query('jabatan');

        // Cari jabatan berdasarkan nama
        $jabatan = Jabatan::where('nama_jabatan', $jabatanNama)->first();

        if (!$jabatan) {
            return response()->json(['nik' => '']);
        }

        // Hitung jumlah karyawan di jabatan itu tahun ini
        $count = Karyawan::whereYear('created_at', $tahun)
            ->where('jabatan_id', $jabatan->id)
            ->count() + 1;

        // Format nomor urut jadi 3 digit
        $nomorUrut = str_pad($count, 3, '0', STR_PAD_LEFT);

        // Buat NIK
        $nik = "{$tahun}-{$jabatanNama}-{$nomorUrut}";

        return response()->json(['nik' => $nik]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:karyawan',
            'telepon' => 'required|string',
            'jabatan_id' => 'required|exists:jabatan,id',
        ]);

        // Ambil tahun saat ini
        $tahun = date('Y');

        // Ambil nama jabatan
        $jabatan = Jabatan::findOrFail($request->jabatan_id);

        // Hitung jumlah karyawan dengan jabatan tersebut di tahun ini
        $count = Karyawan::whereYear('created_at', $tahun)
            ->where('jabatan_id', $request->jabatan_id)
            ->count() + 1; // Urutan baru

        // Format nomor urut menjadi tiga digit (001, 002, 003)
        $nomorUrut = str_pad($count, 3, '0', STR_PAD_LEFT);

        // Buat NIK
        $nik = "{$tahun}-{$jabatan->nama_jabatan}-{$nomorUrut}";

        // Simpan data
        Karyawan::create([
            'nik' => $nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jabatan_id' => $request->jabatan_id,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('karyawan.edit', compact('karyawan', 'jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email',
            'telepon' => 'required|string',
            'jabatan_id' => 'required|exists:jabatan,id',
        ]);

        $karyawan = Karyawan::findOrFail($id);
        $karyawan->update($request->all());
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $karyawan->delete();
        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus!');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new KaryawanImport, $request->file('file'));

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diimport!');
    }
}
