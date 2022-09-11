<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
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
        $otherUser = User::where('email','=', 'other.user@gmail.com')->first();

        Product::create([
            'label' => 'product 1',
            'sale_price' => 1000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $user->id
        ]);

        Product::create([
            'label' => 'Product 2',
            'sale_price' => 2000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'product 1',
            'sale_price' => 1000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $otherUser->id
        ]);

        Product::create([
            'label' => 'Product 2',
            'sale_price' => 2000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $otherUser->id
        ]);
    }
}
