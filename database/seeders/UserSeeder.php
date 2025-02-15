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
                'kd_user' => 'USR-250200001',
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('rahasia'),
                'kd_permission_admin' => 'PA-250200001',
            ],
            [
                'kd_user' => 'USR-250200002',
                'name' => 'Admin Member',
                'email' => 'adminmember@gmail.com',
                'password' => bcrypt('rahasia'),
                'kd_permission_admin' => 'PA-250200002',
            ],
            [
                'kd_user' => 'USR-250200003',
                'name' => 'Admin Gudang',
                'email' => 'admingudang@gmail.com',
                'password' => bcrypt('rahasia'),
                'kd_permission_admin' => 'PA-250200003',
            ],
        ]);
    }
}
