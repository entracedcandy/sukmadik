<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SesiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
              DB::table('sesi')->insert([
                ['nama_sesi' => 'sesi 1','start' => '08:00','end' => '09:00'],
                ['nama_sesi' => 'sesi 2','start' => '09:00','end' => '10:00'],
                ['nama_sesi' => 'sesi 3','start' => '10:00','end' => '11:00'],
                ['nama_sesi' => 'sesi 4','start' => '11:00','end' => '12:00'],
                ['nama_sesi' => 'Istirahat','start' => '12:00','end' => '13:00'],
                ['nama_sesi' => 'sesi 5','start' => '13:00','end' => '14:00'],
                ['nama_sesi' => 'sesi 6','start' => '14:00','end' => '15:00'],
                ['nama_sesi' => 'sesi 7','start' => '15:00','end' => '16:00'],
                ['nama_sesi' => 'sesi 8','start' => '16:00','end' => '17:00'],

        ]);
    }
}
