<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PotonganSeeder extends Seeder
{
    public function run()
    {
        DB::table('potongan')->insert([
            [
                'slip_gaji_id' => 1,
                'pajak' => 500000,
                'bpjs' => 200000,
                'potongan_lainnya' => 100000,
            ],
        ]);
    }
}
