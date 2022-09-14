<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\UniqueNumber;
use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\Sanctum;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', '=', 'test.user@gmail.com')->first();

        for ($count = 0; $count <= 100; $count++) {
            Sanctum::actingAs($user);
            $orderInfo = [
                'number' => UniqueNumber::generateNumber('Order', $user->unique_number),
                'user_id' => $user->id
            ];
            Order::create($orderInfo
            );
        }
    }
}
