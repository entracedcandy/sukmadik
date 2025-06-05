<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('jurusan')->insert([        
            ['nama_jurusan' => 'Teknologi Informasi','id_kampus' => 4],
            ['nama_jurusan' => 'Manajemen Agribisnis','id_kampus' => 4],
            ['nama_jurusan' => 'Teknologi informasi','id_kampus' => 1],
            ['nama_jurusan' => 'Produksi pertanian','id_kampus' => 1],
            ['nama_jurusan' => 'Teknologi Pertanian','id_kampus' => 1],
            ['nama_jurusan' => 'Peternakan','id_kampus' => 1],
            ['nama_jurusan' => 'Menejemen agribisnis','id_kampus' => 1],
            ['nama_jurusan' => 'Bahasa, Komunikasi dan Pariwisata','id_kampus' => 1],
            ['nama_jurusan' => 'Kesehatan','id_kampus' => 1],
            ['nama_jurusan' => 'Teknik','id_kampus' => 1],
            ['nama_jurusan' => 'Bisnis','id_kampus' => 1],
            ['nama_jurusan' => 'Teknologi Informasi','id_kampus' => 2],
            ['nama_jurusan' => 'Teknologi Pertanian','id_kampus' => 2],
            ['nama_jurusan' => 'Bahasa, Komunikasi dan Pariwisata','id_kampus' => 2],
            ['nama_jurusan' => 'Teknologi Informasi','id_kampus' => 3],
            ['nama_jurusan' => 'Manajemen Agribisnis','id_kampus' => 3],
            ['nama_jurusan' => 'Manajemen Agribisnis','id_kampus' => 5],
            ['nama_jurusan' => 'Kesehatan','id_kampus' => 5],

            
            
        ]);
        
    }
}
