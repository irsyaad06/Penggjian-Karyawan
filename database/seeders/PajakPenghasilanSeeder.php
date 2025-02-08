<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PajakPenghasilan;
use App\Models\Karyawan;

class PajakPenghasilanSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan

        foreach ($karyawan as $k) {
            PajakPenghasilan::create([
                'karyawan_id' => $k->id,
                'tahun' => now()->year,
                'bulan' => now()->month,
                'jumlah_pajak' => rand(100000, 500000),
                'status_pembayaran' => 'belum_bayar',
            ]);
        }
    }
}
