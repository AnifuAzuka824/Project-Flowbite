<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'nis' => fake()->unique()->numerify('2026#####'),
            'classroom_id' => Classroom::inRandomOrder()->first()?->id ?? Classroom::factory(),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['Active', 'Inactive']),
        ];
    }
}
