<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    public function run(): void
    {
        // Loop 10 pasangan kode+nama jurusan dari konstanta model
        foreach (Major::DEFAULTS as $code => $name) {
            // Insert satu baris per jurusan (RPL, TKJ, DKV, dst.)
            Major::create([
                'code' => $code,
                'name' => $name,
            ]);
        }
    }
}
