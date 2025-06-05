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
            ['Nama_golongan' => 'A'],
            ['Nama_golongan' => 'B'],
            ['Nama_golongan' => 'C'],
            ['Nama_golongan' => 'D'],
            ['Nama_golongan' => 'E'],
            ['Nama_golongan' => 'F'],
            ['Nama_golongan' => 'G'],
            ['Nama_golongan' => 'H'],

        ]);
    }
}
