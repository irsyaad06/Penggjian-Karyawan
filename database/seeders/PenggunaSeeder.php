<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengguna')->insert([
            [
                'nama' => 'Admin Utama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'hak_akses_id' => 1, // Admin
            ],
            [
                'nama' => 'Budi Karyawan',
                'email' => 'budi@example.com',
                'password' => Hash::make('password'),
                'hak_akses_id' => 2, // Karyawan
            ],
        ]);
    }
}
