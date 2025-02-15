<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('member')->insert([
            [
                'kd_member' => '25020899',
                'kd_pangkat' => 'PT-250200001',
                'kd_upline' => '25020899',
                'kd_atasan' => '25020899',
                'namaLengkap' => 'Admin',
                'nohp' => '08000000000',
                'nowhatsapp' => '08000000000',
                'image' => 'default.png',
                'alamat' => 'tidak ada',
                'provinsi' => 73,
                'kabupaten' => 7371,
                'kecamatan' => 7371100,
                'kodePos' => 'tidak ada',
            ],
        ]);
    }
}
