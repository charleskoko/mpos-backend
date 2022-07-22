<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','=', 'test.user@gmail.com')->first();

        Product::create([
            'label' => 'product 1',
            'price' => 1000,
            'user_id' => $user->id
        ]);

        Product::create([
            'label' => 'Product 2',
            'price' => 2000,
            'user_id' => $user->id
        ]);
    }
}
