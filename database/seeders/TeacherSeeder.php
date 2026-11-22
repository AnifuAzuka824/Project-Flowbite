<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Kumpulan id mapel
        $subjectIds = Subject::pluck('id');

        // 1 guru = 1 mapel (OneToOne)
        foreach ($subjectIds->take(18) as $subjectId) {
            Teacher::factory()->create([
                'subject_id' => $subjectId,
            ]);
        }

        // Kelompokkan guru per jurusan untuk pembagian kelas
        $teachersByMajor = Teacher::with('subject')->get()->groupBy(function ($teacher) {
            return $teacher->subject->major_id;
        });

        $counters = [];

        // Iterasi semua kelas
        foreach (Classroom::orderBy('id')->get() as $classroom) {
            $pool = $teachersByMajor->get($classroom->major_id);

            // Lewati kelas yang jurusannya belum punya guru
            if ($pool === null || $pool->isEmpty()) {
                continue;
            }

            // Round-robin: 1 guru mengampu beberapa kelas (OneToMany)
            $index = $counters[$classroom->major_id] ?? 0;
            $classroom->update([
                'teacher_id' => $pool[$index % $pool->count()]->id,
            ]);
            $counters[$classroom->major_id] = $index + 1;
        }
    }
}
