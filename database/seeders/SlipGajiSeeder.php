<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlipGajiSeeder extends Seeder
{
    public function run()
    {
        DB::table('slip_gaji')->insert([
            [
                'karyawan_id' => 1,
                'gaji_bersih' => 4500000,
                'pajak' => 500000,
                'potongan_bpjs' => 200000,
                'tanggal_gajian' => '2025-02-01',
            ],
        ]);
    }
}
