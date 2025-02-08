<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cuti;
use App\Models\Karyawan;

class CutiSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::all(); // Ambil semua data karyawan

        foreach ($karyawan as $k) {
            Cuti::create([
                'karyawan_id' => $k->id,
                'jenis_cuti' => 'Cuti Tahunan',
                'tanggal_mulai' => now()->addDays(rand(1, 30)),
                'tanggal_selesai' => now()->addDays(rand(31, 60)),
                'status' => 'pending',
            ]);
        }
    }
}
