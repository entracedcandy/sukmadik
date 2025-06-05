<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengajuan_bimbingans')->insert([
            [
                'nama_pengajuan' => 'Corbuziero Dagusquero',
                'NIM' => 'E41231423',
                'catatan' => 'Ingin membahas progress tugas akhir bab 1.',
                'tanggal' => Carbon::parse('2025-05-19 12:00:00'),
                'status' => 'diajukan',
                'id_user' => '2', 
                'id_kampus' => '4',
                'id_jurusan' => '1',
                'id_prodi' => '1',
                'id_semester' => '1',
            ],
       ]);

    }
}
