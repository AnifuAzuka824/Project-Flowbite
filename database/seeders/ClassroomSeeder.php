<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        // Tiga tingkat kelas
        $levels = ['X', 'XI', 'XII'];

        $classrooms = [];

        // Ambil major_id per kode jurusan
        foreach (Major::orderBy('id')->pluck('id', 'code') as $code => $majorId) {
            // RPL 2 rombel, jurusan lain 1
            $sections = $code === 'RPL' ? [1, 2] : [1];

            foreach ($levels as $level) {
                foreach ($sections as $section) {
                    // Bentuk nama "X RPL 1" beserta major_id
                    $classrooms[] = [
                        'name' => "$level $code $section",
                        'major_id' => $majorId,
                    ];
                }
            }
        }

        // Bulk insert sekali jalan
        DB::table('classrooms')->insert($classrooms);
    }
}
