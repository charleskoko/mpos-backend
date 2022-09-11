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
            'sale_price' => 600,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);

        Product::create([
            'label' => 'RHINO ENERGY MALT - 33cl',
            'sale_price' => 500,
            'purchase_price' => 500,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 60cl',
            'sale_price' => 600,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 50cl',
            'sale_price' => 500,
            'purchase_price' => 500,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE - 33cl',
            'sale_price' => 400,
            'purchase_price' => 400,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 60cl',
            'sale_price' => 600,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 50cl',
            'sale_price' => 500,
            'purchase_price' => 500,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'IVOIRE BLACK - 33cl',
            'sale_price' => 600,
            'stock' => 100,
            'purchase_price' => 600,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'DESPERADOS - 33cl',
            'sale_price' => 600,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'DESPERADOS - 50cl',
            'sale_price' => 750,
            'purchase_price' => 750,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'HEINEKEN - 50cl',
            'sale_price' => 700,
            'purchase_price' => 700,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'HEINEKEN - 33cl',
            'sale_price' => 600,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);
        Product::create([
            'label' => 'HEINEKEN (cannette) - 50cl',
            'sale_price' => 750,
            'purchase_price' => 600,
            'stock' => 100,
            'user_id' => $user->id
        ]);
    }
}
