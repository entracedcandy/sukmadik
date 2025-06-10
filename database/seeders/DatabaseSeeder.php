<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KampusSeeder::class,
            JurusanSeeder::class,
            ProdiSeeder::class,
            UserSeeder::class,
            GolonganSeeder::class,
            SemesterSeeder::class,
            JadwalSeeder::class,
            SesiSeeder::class,
            MatkulSeeder::class,
            RuanganSeeder::class,
            DetailJadwalSeeder::class,
        ]);
    }
}
