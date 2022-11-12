<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Refund;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Refund>
 */
class RefundFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $order = Order::inRandomOrder()->first();
        return [
            'reason' => $this->faker->randomElement(Refund::REASONS),
            'amount_refunded' => rand(0,500),
            'order_id' => $order->id,
        ];
    }
}
