<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        DB::table('jabatan')->insert([
            ['nama' => 'Manager', 'gaji_pokok' => 10000000, 'tunjangan' => 2000000],
            ['nama' => 'Staff', 'gaji_pokok' => 5000000, 'tunjangan' => 1000000],
        ]);
    }
}
