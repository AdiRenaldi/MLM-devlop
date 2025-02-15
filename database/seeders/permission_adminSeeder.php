<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class permission_adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission_admin')->insert([
            [
                'kd_permission_admin' => 'PA-250200001',
                'tier' => 'super_admin',
                'permission' => 'login, dashboard, member, product, gudangUtama, transaksi, gudangCabang, notifikasi, reward, promo, stok, pengaturan, profileGudang, pangkat, event',
            ],
            [
                'kd_permission_admin' => 'PA-250200002',
                'tier' => 'admin_member',
                'permission' => 'login, dashboard, member, notifikasi, reward, promo, pengaturan, pangkat, event',
            ],
            [
                'kd_permission_admin' => 'PA-250200003',
                'tier' => 'admin_gudang',
                'permission' => 'login, dashboard, product, gudangUtama, transaksi, gudangCabang, stok, profileGudang',
            ],
        ]);
    }
}
