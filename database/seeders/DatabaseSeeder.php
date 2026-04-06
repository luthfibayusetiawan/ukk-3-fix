<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         Admin::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'created_at' => now()
        ]);
         Siswa::create([
            'nisn' => '1111111111',
            'nama' => 'satria',
            'kelas' => 'XII RPL 1',
            'password' => Hash::make('admin123'),
            'created_at' => now(),
        ]);
    }
}
