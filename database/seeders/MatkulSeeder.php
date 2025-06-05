<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

        DB::table('matkul')->insert([
            
            ['nama_matkul' => 'Workshop Mobile Framework B','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Workshop Web Framework B','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Workshop Mobile Framework A','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Workshop Web Framework A','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Manajemen Kualitas Perangkat Lunak','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Perawatan Perangkat Lunak','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Pengujian Perangkat Lunak','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Literasi Digital','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Kewirausahaan','id_prodi' => '1','id_semester' => '4'],
['nama_matkul' => 'Workshop Sistem Informasi Berbasis Desktop B','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Workshop Manajemen Proyek B','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Workshop Sistem Informasi Berbasis Desktop A','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Workshop Manajemen Proyek A','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Perencanaan Proyek Perangkat Lunak','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Interaksi  Manusia dan Komputer','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Sistem Aplikasi Berbasis Proyek','id_prodi' => '1','id_semester' => '2'],
['nama_matkul' => 'Data Warehouse','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Teknik Penulisan Ilmiah','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Tata Kelola Teknologi Informasi A','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Proyek Sistem Informasi A','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Tata Kelola Teknologi Informasi B','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Proyek Sistem Informasi B','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Developer Operational A','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Workshop Developer Operational B','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Statistika','id_prodi' => '1','id_semester' => '6'],
['nama_matkul' => 'Trend Teknologi','id_prodi' => '1','id_semester' => '6'],



        ]);
    }
}