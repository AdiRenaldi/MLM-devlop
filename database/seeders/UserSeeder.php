<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'kd_user' => '0000',
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt(''),
                'kd_permission_admin' => 'PA-250200001',
            ],
            [
                'kd_user' => '00000',
                'name' => 'Admin Member',
                'email' => 'adminmember@gmail.com',
                'password' => bcrypt(''),
                'kd_permission_admin' => 'PA-250200002',
            ],
            [
                'kd_user' => '00000',
                'name' => 'Admin Gudang',
                'email' => 'admingudang@gmail.com',
                'password' => bcrypt(''),
                'kd_permission_admin' => 'PA-250200003',
            ],
        ]);
    }
}
