<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        $classroom = fake()->unique()->randomElement([
            ['name' => 'X RPL 1', 'major_code' => 'RPL'],
            ['name' => 'X RPL 2', 'major_code' => 'RPL'],
            ['name' => 'XI RPL 1', 'major_code' => 'RPL'],
            ['name' => 'XI RPL 2', 'major_code' => 'RPL'],
            ['name' => 'XII RPL 1', 'major_code' => 'RPL'],
            ['name' => 'XII RPL 2', 'major_code' => 'RPL'],
            ['name' => 'X DKV 1', 'major_code' => 'DKV'],
            ['name' => 'XI DKV 1', 'major_code' => 'DKV'],
            ['name' => 'XII DKV 1', 'major_code' => 'DKV'],
            ['name' => 'X TG 1', 'major_code' => 'TG'],
            ['name' => 'XI TG 1', 'major_code' => 'TG'],
            ['name' => 'XII TG 1', 'major_code' => 'TG'],
            ['name' => 'X DG 1', 'major_code' => 'DG'],
            ['name' => 'XI DG 1', 'major_code' => 'DG'],
            ['name' => 'XII DG 1', 'major_code' => 'DG'],
            ['name' => 'X AM 1', 'major_code' => 'AM'],
            ['name' => 'XI AM 1', 'major_code' => 'AM'],
            ['name' => 'XII AM 1', 'major_code' => 'AM'],
            ['name' => 'X MLBP 1', 'major_code' => 'MLBP'],
            ['name' => 'XI MLBP 1', 'major_code' => 'MLBP'],
            ['name' => 'XII MLBP 1', 'major_code' => 'MLBP'],
            ['name' => 'X TKJ 1', 'major_code' => 'TKJ'],
            ['name' => 'XI TKJ 1', 'major_code' => 'TKJ'],
            ['name' => 'XII TKJ 1', 'major_code' => 'TKJ'],
            ['name' => 'X TAV 1', 'major_code' => 'TAV'],
            ['name' => 'XI TAV 1', 'major_code' => 'TAV'],
            ['name' => 'XII TAV 1', 'major_code' => 'TAV'],
            ['name' => 'X DPIB 1', 'major_code' => 'DPIB'],
            ['name' => 'XI DPIB 1', 'major_code' => 'DPIB'],
            ['name' => 'XII DPIB 1', 'major_code' => 'DPIB'],
            ['name' => 'X TO 1', 'major_code' => 'TO'],
            ['name' => 'XI TO 1', 'major_code' => 'TO'],
            ['name' => 'XII TO 1', 'major_code' => 'TO'],
        ]);

        $major = Major::firstOrCreate(
            ['code' => $classroom['major_code']],
            ['name' => Major::DEFAULTS[$classroom['major_code']]]
        );

        return [
            'name' => $classroom['name'],
            'major_id' => $major->id,
        ];
    }
}
