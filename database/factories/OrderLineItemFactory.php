<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderLineItem>
 */
class OrderLineItemFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $selectedProduct = Product::inRandomOrder()->first();
        return [
            'product_id' =>  $selectedProduct->id,
            'product_label' => $selectedProduct->label,
            'order_id' => Order::inRandomOrder()->first()->id,
            'price' => $this->faker->randomFloat(2,1000,20000),
            'amount' => $this->faker->randomDigit()
        ];
    }
}
