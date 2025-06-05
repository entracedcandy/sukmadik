<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('semester')->insert([        
        ['nama_semester' => '1','status' => 0],
        ['nama_semester' => '2','status' => 1],
        ['nama_semester' => '3','status' => 0],
        ['nama_semester' => '4','status' => 1],
        ['nama_semester' => '5','status' => 0],
        ['nama_semester' => '6','status' => 1],
        ['nama_semester' => '7','status' => 0],
        ['nama_semester' => '8','status' => 1],


        ]);
    }
}
