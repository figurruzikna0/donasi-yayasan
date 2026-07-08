<?php

namespace Database\Factories;

use App\Models\FosterChild;
use Illuminate\Database\Eloquent\Factories\Factory;

class FosterChildFactory extends Factory
{
    protected $model = FosterChild::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(5, 18),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'description' => fake()->sentence(),
            'photo' => null,
            'status' => 'Tersedia',
        ];
    }

    public function diasuh(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Diasuh',
        ]);
    }
}
