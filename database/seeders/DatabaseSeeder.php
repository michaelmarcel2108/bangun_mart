<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
    \App\Models\User::create([
        'name' => 'Admin BangunMart',
        'email' => 'admin@gmail.com',
        'password' => bcrypt('admin123'),
        'jabatan' => 'admin',
    ]);

    \App\Models\User::create([
        'name' => 'Kasir 1',
        'email' => 'kasir@gmail.com',
        'password' => bcrypt('kasir123'),
        'jabatan' => 'kasir',
    ]);
}
}
