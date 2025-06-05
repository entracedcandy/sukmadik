<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'nip' => '1234567890',
                'nama' => 'Admin',
                'email' => 'admin@example.com',
                'level' => '1',
                'password' => Hash::make('123'),
                'id_prodi' => 1,
            ],
             [
                'nip' => ' T19900525202105101',
                'nama' => 'Zayd Al Munshif, A.Md.Kom',
                'email' => 'zayd@polije.teknisi.com',
                'level' => '1',
                'password' => Hash::make('123'),
                'id_prodi' => 1,
            ],
            [
                'nip' => ' T19960730202105101',
                'nama' => 'Achmad Syaifulloh, A.Ma.',
                'email' => 'Syaifullah@polije.teknisi.com',
                'level' => '1',
                'password' => Hash::make('123'),
                'id_prodi' => 1,
            ],
            [
                'nip' => '199012072024061001',
                'nama' => 'Rifqi Aji Widarso, S.T. M.T.',
                'email' => 'rifqiajiw@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //4
            ],
            [
                'nip' => '199404232024061002',
                'nama' => 'Mochammad Rifki Ulil Albaab, ST., M.Tr.T.',
                'email' => 'rifkiulil@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //5
            ],
            [
                'nip' => '197308312008011003',
                'nama' => 'Agus Purwadi, ST.MT',
                'email' => 'aguspurwadi@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //6
            ],
            [
                'nip' => ' 199508242022031015',
                'nama' => 'Adi Sucipto, S.ST., M.Tr.T.',
                'email' => 'adisucipto@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //7
            ],
            [
                'nip' => '199311242024062003',
                'nama' => 'Sholihah Ayu Wulandari, S.ST., M.Tr.T.',
                'email' => 'sholihahayu@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //8
            ],
            [
                'nip' => '199203072023211018',
                'nama' => 'Dhony Manggala Putra, S.E., M.M.',
                'email' => 'dhonymanggala@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //9
            ],
            [
                'nip' => '198203122005012002',
                'nama' => 'Rani Purbaningtyas, S.Kom., MT.',
                'email' => 'ranipurbaningtyas@polije.com',
                'level' => '2',
                'password' => Hash::make('123'),
                'id_prodi' => 1, //10
            ],
        ]);
    }
}
