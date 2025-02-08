<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Potongan;
use App\Models\SlipGaji;

class PotonganController extends Controller
{
    public function index()
    {
        $potongan = Potongan::with('slipGaji.karyawan')->get();
        return view('potongan.index', compact('potongan'));
    }

    public function create()
    {
        $slipGaji = SlipGaji::with('karyawan')->get();
        return view('potongan.create', compact('slipGaji'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'slip_gaji_id' => 'required|exists:slip_gaji,id',
            'pajak' => 'required|numeric|min:0',
            'bpjs' => 'required|numeric|min:0',
            'potongan_lainnya' => 'nullable|numeric|min:0',
        ]);

        Potongan::create($request->all());
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $potongan = Potongan::findOrFail($id);
        $slipGaji = SlipGaji::with('karyawan')->get();
        return view('potongan.edit', compact('potongan', 'slipGaji'));
    }

    public function update(Request $request, $id)
    {
        $potongan = Potongan::findOrFail($id);
        $request->validate([
            'pajak' => 'required|numeric|min:0',
            'bpjs' => 'required|numeric|min:0',
            'potongan_lainnya' => 'nullable|numeric|min:0',
        ]);

        $potongan->update($request->all());
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Potongan::destroy($id);
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil dihapus!');
    }
}
