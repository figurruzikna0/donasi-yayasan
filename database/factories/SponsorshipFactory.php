<?php

namespace Database\Factories;

use App\Models\FosterChild;
use App\Models\Sponsorship;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SponsorshipFactory extends Factory
{
    protected $model = Sponsorship::class;

    public function definition(): array
    {
        return [
            'foster_child_id' => FosterChild::factory(),
            'user_id' => User::factory(),
            'order_id' => 'SPONSOR-' . fake()->unique()->randomNumber(8),
            'donor_name' => fake()->name(),
            'donor_email' => fake()->email(),
            'donor_phone' => '62' . fake()->numerify('8##########'),
            'amount' => fake()->numberBetween(100000, 1000000),
            'package' => fake()->randomElement(['Reguler', 'Premium', 'Eksekutif']),
            'package_description' => fake()->sentence(),
            'payment_method' => 'Midtrans',
            'status' => 'pending',
        ];
    }

    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
            'starts_at' => now()->subMonths(2),
            'expires_at' => now()->addMonths(10),
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
            'starts_at' => now()->subMonths(14),
            'expires_at' => now()->subMonths(2),
        ]);
    }
}
