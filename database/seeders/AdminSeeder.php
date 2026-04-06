<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now()
        ]);

        // Bisa tambah admin lain kalau mau
        Admin::create([
            'username' => 'superadmin',
            'password' => Hash::make('super123'),
            'created_at' => now()
        ]);

         Admin::create([
            'username' => 'superadmin',
            'password' => Hash::make('super123'),
            'created_at' => now()
        ]);
    }
}