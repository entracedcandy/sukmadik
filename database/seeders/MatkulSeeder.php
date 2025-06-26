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
            
            ['nama_matkul' => 'Workshop Mobile Framework B','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 5,'id_pengampu2' => NULL,'id_matkul' => '1', ],
            ['nama_matkul' => 'Workshop Web Framework B','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '2', ],
            ['nama_matkul' => 'Workshop Mobile Framework A','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 7,'id_pengampu2' => NULL,'id_matkul' => '3', ],
            ['nama_matkul' => 'Workshop Web Framework A','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '4', ],
            ['nama_matkul' => 'Manajemen Kualitas Perangkat Lunak','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '5', ],
            ['nama_matkul' => 'Perawatan Perangkat Lunak','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 8,'id_pengampu2' => 5,'id_matkul' => '6', ],
            ['nama_matkul' => 'Pengujian Perangkat Lunak','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '7', ],
            ['nama_matkul' => 'Literasi Digital','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 4,'id_pengampu2' => 7,'id_matkul' => '8', ],
            ['nama_matkul' => 'Kewirausahaan','id_prodi' => '1','id_semester' => '4','id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '9', ],
            ['nama_matkul' => 'Workshop Sistem Informasi Berbasis Desktop B','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '10', ],
            ['nama_matkul' => 'Workshop Manajemen Proyek B','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '11', ],
            ['nama_matkul' => 'Workshop Sistem Informasi Berbasis Desktop A','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 10,'id_pengampu2' => 4,'id_matkul' => '12', ],
            ['nama_matkul' => 'Workshop Manajemen Proyek A','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '13', ],
            ['nama_matkul' => 'Perencanaan Proyek Perangkat Lunak','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 7,'id_pengampu2' => 9,'id_matkul' => '14', ],
            ['nama_matkul' => 'Interaksi  Manusia dan Komputer','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 5,'id_pengampu2' => 7,'id_matkul' => '15', ],
            ['nama_matkul' => 'Sistem Aplikasi Berbasis Proyek','id_prodi' => '1','id_semester' => '2','id_pengampu1' => 8,'id_pengampu2' => 7,'id_matkul' => '16', ],
            ['nama_matkul' => 'Data Warehouse','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 5,'id_pengampu2' => 9,'id_matkul' => '17', ],
            ['nama_matkul' => 'Teknik Penulisan Ilmiah','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '18', ],
            ['nama_matkul' => 'Workshop Tata Kelola Teknologi Informasi A','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '19', ],
            ['nama_matkul' => 'Workshop Proyek Sistem Informasi A','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '20', ],
            ['nama_matkul' => 'Workshop Tata Kelola Teknologi Informasi B','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 5,'id_pengampu2' => NULL,'id_matkul' => '21', ],
            ['nama_matkul' => 'Workshop Proyek Sistem Informasi B','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '22', ],
            ['nama_matkul' => 'Workshop Developer Operational A','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '23', ],
            ['nama_matkul' => 'Workshop Developer Operational B','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 7,'id_pengampu2' => NULL,'id_matkul' => '24', ],
            ['nama_matkul' => 'Statistika','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 8,'id_pengampu2' => 4,'id_matkul' => '25', ],
            ['nama_matkul' => 'Trend Teknologi','id_prodi' => '1','id_semester' => '6','id_pengampu1' => 8,'id_pengampu2' => 5,'id_matkul' => '26', ],




        ]);
    }
}