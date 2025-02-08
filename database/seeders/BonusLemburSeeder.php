<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\BonusLembur;
use App\Models\Karyawan;

class BonusLemburSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan

        foreach ($karyawan as $k) {
            BonusLembur::create([
                'karyawan_id' => $k->id,
                'bulan' => now()->month,
                'tahun' => now()->year,
                'bonus' => rand(100000, 500000),
                'lembur' => rand(50000, 200000),
                'status_bayar' => 'belum_bayar',
            ]);
        }
    }
}
