<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderLineItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

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
            OrderLineItem::factory()->create([
                'product_id' => $productIdArray[random_int(0,count($productIdArray) -1)],
                'order_id' => $orderId
            ]);
        }
    }
}
