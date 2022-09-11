<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'label' => $this->faker->company,
            'sale_price' => $salePrice = $this->faker->randomFloat('2','1000','10000'),
            'purchase_price' => $this->faker->randomFloat('2','500',$salePrice),
            'stock' => $this->faker->randomFloat('2','24','50'),
            'user_id' => User::inRandomOrder()->first()->id
        ];
    }
}
