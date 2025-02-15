<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class PangkatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pangkat')->insert([
            [
                'kd_pangkat' => 'PT-250200001',
                'nama_pangkat' => 'Admin',
            ],
        ]);
    }
}
