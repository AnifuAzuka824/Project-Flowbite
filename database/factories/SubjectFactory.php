<?php

namespace Database\Factories;

use App\Models\Major;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    public function definition(): array
    {
        $subjects = [
            ['name' => 'Pemrograman Berorientasi Objek', 'code' => 'PBO', 'major_code' => 'RPL'],
            ['name' => 'Pemrograman Web dan Perangkat Bergerak', 'code' => 'PWPB', 'major_code' => 'RPL'],
            ['name' => 'Basis Data', 'code' => 'BD', 'major_code' => 'RPL'],
            ['name' => 'Pemodelan Perangkat Lunak', 'code' => 'PPL', 'major_code' => 'RPL'],
            ['name' => 'Produk Kreatif dan Kewirausahaan', 'code' => 'PKK', 'major_code' => 'MLBP'],
            ['name' => 'Sistem Informasi Manajemen', 'code' => 'SIM', 'major_code' => 'MLBP'],
            ['name' => 'Jaringan Komputer Dasar', 'code' => 'JKD', 'major_code' => 'TKJ'],
            ['name' => 'Sistem Komputer', 'code' => 'SK', 'major_code' => 'TKJ'],
            ['name' => 'Informatika', 'code' => 'INF', 'major_code' => 'RPL'],
            ['name' => 'Desain Grafis', 'code' => 'DG', 'major_code' => 'DG'],
            ['name' => 'Administrasi Infrastruktur Jaringan', 'code' => 'AIJ', 'major_code' => 'TKJ'],
            ['name' => 'Pemrograman Dasar', 'code' => 'PD', 'major_code' => 'RPL'],
            ['name' => 'Kecerdasan Buatan', 'code' => 'KB', 'major_code' => 'RPL'],
            ['name' => 'Internet of Things', 'code' => 'IOT', 'major_code' => 'TKJ'],
            ['name' => 'Keamanan Siber', 'code' => 'KS', 'major_code' => 'TKJ'],
            ['name' => 'Cloud Computing', 'code' => 'CC', 'major_code' => 'TKJ'],
            ['name' => 'Mobile Programming', 'code' => 'MP', 'major_code' => 'RPL'],
            ['name' => 'User Interface Design', 'code' => 'UID', 'major_code' => 'RPL'],
        ];

        $subject = fake()->unique()->randomElement($subjects);

        $major = Major::firstOrCreate(
            ['code' => $subject['major_code']],
            ['name' => Major::DEFAULTS[$subject['major_code']]]
        );

        return [
            'name' => $subject['name'],
            'code' => $subject['code'],
            'major_id' => $major->id,
            'description' => fake()->sentence(),
        ];
    }
}
