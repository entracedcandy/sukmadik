<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
         DB::table('golongan')->insert([        
            ['Nama_golongan' => 'A', 'status' => 0],
            ['Nama_golongan' => 'B', 'status' => 0],
            ['Nama_golongan' => 'A & B', 'status' => 1],
        ]);
    }
}

