<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nrp' => '12345678',
            'nama' => 'Admin',
            'tanggal_lahir' => '1990-01-01',
            'email' => 'admin@pusdikzi.com',
            'password' => Hash::make('1990-01-01'), // Using tanggal lahir as password
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
} 