<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'nip' => fake()->unique()->numberBetween(1000000000, 9999999999),
            'subject_id' => Subject::factory(),
            'start_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }
}
