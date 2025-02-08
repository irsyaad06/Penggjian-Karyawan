<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use App\Models\HakAkses;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::with('hakAkses')->get();
        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        $hakAkses = HakAkses::all();
        return view('pengguna.create', compact('hakAkses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna',
            'password' => 'required|min:6',
            'hak_akses_id' => 'required|exists:hak_akses,id',
        ]);

        Pengguna::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses_id' => $request->hak_akses_id,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $hakAkses = HakAkses::all();
        return view('pengguna.edit', compact('pengguna', 'hakAkses'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $id,
            'hak_akses_id' => 'required|exists:hak_akses,id',
        ]);

        $pengguna->update($request->except('password'));

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pengguna::destroy($id);
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
