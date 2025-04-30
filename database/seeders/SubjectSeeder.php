<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $defaultSubjects = [
            'Materi Konstruksi',
            'Materi Rintangan',
            'Materi PBB Militer',
            'Materi Jihandak',
            'Materi Menembak'
        ];

        foreach ($defaultSubjects as $subject) {
            DB::table('subjects')->insert([
                'nama_materi' => $subject,
                'is_default' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
} 