<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UniqueNumber>
 */
class UniqueNumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'prefix' => $this->faker->randomElement(['ORD', 'INV']),
            'current' => $this->faker->randomDigit(),
            'digits' => $this->faker->randomDigit(),
            'year' => date('Y'),
            'user_id' => User::inRandomOrder()->first()->id
            ];
    }
}
