<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangan')->insert([
            ['nama_ruangan' => 'Lab RSI','id_kampus' => '4'],
            ['nama_ruangan' => 'Lab SKK','id_kampus' => '4'],
            ['nama_ruangan' => 'Ruang 101','id_kampus' => '4'],
            ['nama_ruangan' => 'Ruang Aula','id_kampus' => '4'],

        ]);
    }
}
