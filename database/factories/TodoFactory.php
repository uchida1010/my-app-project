<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rank = ["高", "中", "低"];

        return [
            'name' => fake()->name(),
            'rank' => Arr::random($rank),
            'deadline' => fake()-> dateTimeBetween('+1 week', '+2 week'),
            'schedule' => fake()-> dateTimeBetween('now', '+1 week'),
            'progress' => fake()->numberBetween(1, 100),
            'others' => '備考'
        ];
    }
}
