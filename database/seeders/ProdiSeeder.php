<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('prodi')->insert([  
        ['nama_prodi' => 'Teknik Informatika','id_jurusan' => '1'],
['nama_prodi' => 'Manajemen Agroindustri','id_jurusan' => '2'],
['nama_prodi' => 'Teknik Informatika','id_jurusan' => '3'],
['nama_prodi' => 'Manajemen informatika','id_jurusan' => '3'],
['nama_prodi' => 'Teknik Komputer','id_jurusan' => '3'],
['nama_prodi' => 'Bisnis Digital','id_jurusan' => '3'],
['nama_prodi' => 'Teknologi Rekayasa Komputer','id_jurusan' => '3'],
['nama_prodi' => 'Produksi Ternak','id_jurusan' => '6'],
['nama_prodi' => 'Manajemen Bisnis Unggas','id_jurusan' => '6'],
['nama_prodi' => 'Teknologi Pakan Ternak','id_jurusan' => '6'],
['nama_prodi' => 'Produksi Tanaman Hortikultura','id_jurusan' => '4'],
['nama_prodi' => 'Produksi Tanaman Perkebunan','id_jurusan' => '4'],
['nama_prodi' => 'Teknik Produksi Benih','id_jurusan' => '4'],
['nama_prodi' => 'Teknologi Produksi Tanaman Pangan','id_jurusan' => '4'],
['nama_prodi' => 'Budidaya Tanaman Perkebunan','id_jurusan' => '4'],
['nama_prodi' => 'Pengelolaan Perkebunan Kopi','id_jurusan' => '4'],
['nama_prodi' => 'Keteknikan Pertanian','id_jurusan' => '5'],
['nama_prodi' => 'Teknologi Industri Pangan','id_jurusan' => '5'],
['nama_prodi' => 'Teknologi Rekayasa Pangan','id_jurusan' => '5'],
['nama_prodi' => 'Manajemen Agribisnis','id_jurusan' => '7'],
['nama_prodi' => 'Manjemen Agroindusti','id_jurusan' => '7'],
['nama_prodi' => 'Pascasarjana Agribisnis','id_jurusan' => '7'],
['nama_prodi' => 'Bahasa Inggris','id_jurusan' => '8'],
['nama_prodi' => 'Destinasi Pariwisata','id_jurusan' => '8'],
['nama_prodi' => 'Produksi Media','id_jurusan' => '8'],
['nama_prodi' => 'Manajemen Informasi Kesehatan','id_jurusan' => '9'],
['nama_prodi' => 'Gizi Klinik','id_jurusan' => '9'],
['nama_prodi' => 'Promosi Kesehatan','id_jurusan' => '9'],
['nama_prodi' => 'Teknik Energi Terbarukan','id_jurusan' => '10'],
['nama_prodi' => 'Mesin Otomotif','id_jurusan' => '10'],
['nama_prodi' => 'Teknologi Reyasa Mekatronika','id_jurusan' => '10'],
['nama_prodi' => 'Akutansi Sektor Publik','id_jurusan' => '11'],
['nama_prodi' => 'Manajemen Pemasaran Internasional','id_jurusan' => '11'],
['nama_prodi' => 'Teknik Informatika','id_jurusan' => '12'],
['nama_prodi' => 'Teknologi Industri Pangan','id_jurusan' => '13'],
['nama_prodi' => 'Produksi Media','id_jurusan' => '14'],
['nama_prodi' => 'Teknik Informatika','id_jurusan' => '15'],
['nama_prodi' => 'Manajemen Agroindustri','id_jurusan' => '16'],
['nama_prodi' => 'Manajemen Agribisnis','id_jurusan' => '17'],
['nama_prodi' => 'Manajemen Informasi Kesehatan','id_jurusan' => '18'],
      

        ]);
    }
}
