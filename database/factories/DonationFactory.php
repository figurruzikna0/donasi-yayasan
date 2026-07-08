<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'campaign_id' => Campaign::factory(),
            'user_id' => User::factory(),
            'order_id' => 'DONASI-' . fake()->unique()->randomNumber(8),
            'donor_name' => fake()->name(),
            'donor_email' => fake()->email(),
            'donor_phone' => fake()->phoneNumber(),
            'amount' => fake()->numberBetween(10000, 5000000),
            'payment_method' => 'Midtrans',
            'status' => 'pending',
        ];
    }

    public function success(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'success',
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }
}
