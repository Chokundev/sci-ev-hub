<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // สร้างบัญชี Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@scievhub.com',
            'password' => Hash::make('password123'), // รหัสผ่านคือ password123
            'role' => 'superadmin',
        ]);

        // สร้างบัญชี Admin ธรรมดา
        User::create([
            'name' => 'Admin Manager',
            'email' => 'admin@scievhub.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // สร้างบัญชี ผู้ใช้ทั่วไป (ลูกค้า)
        User::create([
            'name' => 'Customer User',
            'email' => 'user@scievhub.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}