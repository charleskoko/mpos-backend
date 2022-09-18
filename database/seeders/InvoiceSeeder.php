<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\UniqueNumber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
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
            $invoiceInfo = [
                'user_id' => $user->id,
                'order_id'=> $user->id,
                'payment' => Invoice::CASH_PAYMENT,
                'number' => UniqueNumber::generateNumber('Invoice', $user->unique_number,$user->id),
            ];
            Invoice::create($invoiceInfo);
        }
    }
}
