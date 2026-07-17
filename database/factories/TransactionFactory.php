<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'invoice_number' => 'INV-' . fake()->unique()->randomNumber(8),
            'user_id' => User::factory(),
            'campaign_id' => Campaign::factory(),
            'foster_child_id' => null,
            'type' => 'donation',
            'amount' => fake()->numberBetween(10000, 5000000),
            'donor_name' => fake()->name(),
            'donor_phone' => fake()->phoneNumber(),
            'status' => 'verified',
            'message' => null,
        ];
    }
}
