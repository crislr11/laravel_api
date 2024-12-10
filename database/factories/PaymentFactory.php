<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Event;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_id' => Event::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'status' => $this->faker->randomElement(['COMPLETED', 'PENDING', 'FAILED']),
            'transaction_date' => $this->faker->dateTime,
            'payment_method' => $this->faker->randomElement(['CREDIT_CARD', 'PAYPAL', 'BANK_TRANSFER']),
            'deleted' => 0,
        ];
    }
}
