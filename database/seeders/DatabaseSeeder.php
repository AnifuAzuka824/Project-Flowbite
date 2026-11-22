<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // Matikan event model agar seeding cepat & tidak memicu observer
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 akun login default test@example.com
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Urutan wajib ikut FK: Major → Classroom → Subject → Teacher → Student
        $this->call([
            MajorSeeder::class,
            ClassroomSeeder::class,
            SubjectSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
