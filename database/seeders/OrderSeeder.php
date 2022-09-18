<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\UniqueNumber;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Laravel\Sanctum\Sanctum;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $user = User::where('email', '=', 'test.user@gmail.com')->first();
        for ($count = 0; $count <= 100; $count++) {
            $orderInfo = [
                'number' => UniqueNumber::generateNumber('Order', $user->unique_number,$user->id),
                'user_id' => $user->id,
                'created_at' => Carbon::now()->subDays(random_int(0,10))->format('Y-m-d H:i:s'),
            ];
            Order::create($orderInfo
            );
        }
    }
}
