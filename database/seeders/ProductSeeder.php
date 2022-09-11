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
            'label' => 'SMIRNOFF ICE - 33cl',
            'price' => 600,
            'user_id' => $user->id
        ]);

        Product::create([
            'label' => 'RHINO ENERGY MALT - 33cl',
            'price' => 500,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 60cl',
            'price' => 600,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 50cl',
            'price' => 500,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 33cl',
            'price' => 400,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 60cl',
            'price' => 600,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 50cl',
            'price' => 500,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 33cl',
            'price' => 400,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'DESPERADOS - 33cl',
            'price' => 600,
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
            'label' => 'DESPERADOS - 50cl',
            'price' => 750,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'product 1',
            'sale_price' => 1000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $otherUser->id
            'label' => 'HEINEKEN - 50cl',
            'price' => 700,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'Product 2',
            'sale_price' => 2000,
            'purchase_price' => 500,
            'stock' => 24,
            'user_id' => $otherUser->id
            'label' => 'HEINEKEN - 33cl',
            'price' => 600,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'HEINEKEN (cannette) - 50cl',
            'price' => 750,
            'user_id' => $user->id
        ]);
    }
}
