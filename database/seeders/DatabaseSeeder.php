<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database.
     */
    public function run()
    {
        $this->call([
            HakAksesSeeder::class,
            PenggunaSeeder::class,
            JabatanSeeder::class,
            KaryawanSeeder::class,
            SlipGajiSeeder::class, 
            PotonganSeeder::class, 
        ]);
    }
}
