<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengampuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('Detail_Pengampu')->insert([
            ['id_pengampu1' => 5,'id_pengampu2' => NULL,'id_matkul' => '1'],
            ['id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '2'],
            ['id_pengampu1' => 7,'id_pengampu2' => NULL,'id_matkul' => '3'],
            ['id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '4'],
            ['id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '5'],
            ['id_pengampu1' => 8,'id_pengampu2' => 5,'id_matkul' => '6'],
            ['id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '7'],
            ['id_pengampu1' => 4,'id_pengampu2' => 7,'id_matkul' => '8'],
            ['id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '9'],
            ['id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '10'],
            ['id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '11'],
            ['id_pengampu1' => 10,'id_pengampu2' => 4,'id_matkul' => '12'],
            ['id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '13'],
            ['id_pengampu1' => 7,'id_pengampu2' => 9,'id_matkul' => '14'],
            ['id_pengampu1' => 5,'id_pengampu2' => 7,'id_matkul' => '15'],
            ['id_pengampu1' => 8,'id_pengampu2' => 7,'id_matkul' => '16'],
            ['id_pengampu1' => 5,'id_pengampu2' => 9,'id_matkul' => '17'],
            ['id_pengampu1' => 10,'id_pengampu2' => NULL,'id_matkul' => '18'],
            ['id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '19'],
            ['id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '20'],
            ['id_pengampu1' => 5,'id_pengampu2' => NULL,'id_matkul' => '21'],
            ['id_pengampu1' => 9,'id_pengampu2' => NULL,'id_matkul' => '22'],
            ['id_pengampu1' => 4,'id_pengampu2' => NULL,'id_matkul' => '23'],
            ['id_pengampu1' => 7,'id_pengampu2' => NULL,'id_matkul' => '24'],
            ['id_pengampu1' => 8,'id_pengampu2' => 4,'id_matkul' => '25'],
            ['id_pengampu1' => 8,'id_pengampu2' => 5,'id_matkul' => '26'],


        ]);
    }
}
