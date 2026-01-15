<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $admins = [
            [
                'email'       => 'afnan.02alf@gmail.com',
                'name'        => 'Admin Kedua',
                'password'    => 'password',
                'province_id' => 13,
                'regency_id'  => 1305,
                'phone'       => '082154734819',
            ],
            [
                'email'       => 'dialadhyprayoga@gmail.com',
                'name'        => 'Admin Utama',
                'password'    => 'password',
                'province_id' => 13,
                'regency_id'  => 1305,
                'phone'       => '081234567890',
            ],
        ];

        foreach ($admins as $data) {

            $admin = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name'              => $data['name'],
                    'password'          => Hash::make($data['password']),
                    'province_id'       => $data['province_id'],
                    'regency_id'        => $data['regency_id'],
                    'phone'             => $data['phone'],
                    'avatar'            => null,
                    'is_active'         => true,
                    'email_verified_at' => now(),
                ]
            );

            // Pastikan role admin terpasang
            if (!$admin->hasRole('admin')) {
                $admin->assignRole('admin');
            }
        }

        echo "Admin users created/updated successfully.\n";
    }
}
