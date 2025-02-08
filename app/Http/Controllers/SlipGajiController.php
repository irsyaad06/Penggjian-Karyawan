<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlipGaji;
use App\Models\Karyawan;

class SlipGajiController extends Controller
{
    public function index()
    {
        $slipGaji = SlipGaji::with('karyawan')->get();
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
            'gaji_bersih' => 'required|numeric|min:0',
            'pajak' => 'required|numeric|min:0',
            'potongan_bpjs' => 'nullable|numeric|min:0',
            'tanggal_gajian' => 'required|date',
        ]);

        SlipGaji::create($request->all());
        return redirect()->route('slip_gaji.index')->with('success', 'Slip Gaji berhasil ditambahkan!');
    }
}
