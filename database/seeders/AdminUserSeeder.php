<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Buat akun admin default
        $admin = User::firstOrCreate(
            ['email' => 'admin@bimbel.com'],  // <-- ganti sesuai kebutuhan
            [
                'name' => 'Muhammad Afnan Alfian',
                'password' => Hash::make('password123'),  // <-- ganti password
                'province_id' => 73,
                'regency_id' => 7309,
                'phone' => '082154734819',
                'avatar' => null,
                'is_active' => true,
            ]
        );

        // Assign role admin
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        echo "Admin user created/updated successfully.\n";
    }
}
