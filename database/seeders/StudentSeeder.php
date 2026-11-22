<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Classroom::pluck('id') as $classroomId) {
            // Tepat 5 siswa per kelas (OneToMany)
            Student::factory(5)->create([
                'classroom_id' => $classroomId,
            ]);
        }
    }
}
