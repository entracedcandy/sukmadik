<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DetailBimbinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('detail_bimbingan')->insert([  
        ['id_sesi' => '1','id_jadwal' => '1','email' => 'Muhammadnaufaldr@gmail.com','nama' => 'Naufal Dzaky','nim' => 'E41231423','tujuan' => 'Bimbingan TA','catatan' => 'test','tanggal' => '2025-06-30','id_semester' => '4','id_golongan' => '2',],
        ['id_sesi' => '2','id_jadwal' => '1','email' => 'Ricarahma@gmail.com','nama' => 'Rica Rahmahidayatul','nim' => 'E41221149','tujuan' => 'Bimbingan Sempro','catatan' => 'test','tanggal' => '2025-06-30','id_semester' => '6','id_golongan' => '1',],


        ]);
    }
}
