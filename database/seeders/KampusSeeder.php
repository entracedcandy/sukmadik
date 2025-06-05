<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KampusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kampus')->insert([
            ['nama_kampus' => 'Kampus Pusat Jember',
             'alamat' => 'Jl. Mastrip, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121'],
            ['nama_kampus' => 'Kampus 2 Bondowoso',
            'alamat' => 'Jl. Raya Situbondo, Blindungan, Kec. Bondowoso, Kabupaten Bondowoso, Jawa Timur 68211'],
            ['nama_kampus' => 'Kampus 3 Nganjuk',
            'alamat' => 'Kauman, Kec. Nganjuk, Kabupaten Nganjuk, Jawa Timur 64411'],
            ['nama_kampus' => 'Kampus 4 Sidoarjo',
            'alamat' => 'Jl. Sekolahan Jalan Raya, Cangkring, Sidokare, Kec. Sidoarjo, Kabupaten Sidoarjo, Jawa Timur 61214'],
            ['nama_kampus' => 'Kampus 5 Ngawi',
            'alamat' => 'Jl. Ahmad Yani No.54, Klitik, Kec. Ngawi, Kabupaten Ngawi, Jawa Timur 63271'],

        ]);
    }
}
