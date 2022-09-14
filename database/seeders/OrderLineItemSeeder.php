<?php

namespace Database\Seeders;

use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderLineItemSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $user = User::where('email','=', 'test.user@gmail.com')->first();
        $productIdArray = $user->products->pluck('id');
        $orderIdArray= $user->orders->pluck('id');

        foreach ($orderIdArray as $key => $orderId){
            $productId = $productIdArray[random_int(0, count($productIdArray) - 1)];
            $product = Product::where('id', '=', $productId)->first();
            OrderLineItem::create([
                'product_id' => $productId,
                'order_id' => $orderId,
                'price' => $product->sale_price,
                'amount' => random_int(2, 5)
            ]);
        }
    }
}
