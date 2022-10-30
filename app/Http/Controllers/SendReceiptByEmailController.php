<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptEmailRequest;
use App\Mail\SendReceipt;
use App\Models\Order;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Mail;

class SendReceiptByEmailController extends Controller
{
    use ApiResponse;

    public function sendReceiptByEmail(ReceiptEmailRequest $request,Order $order){
        $validatedRequest =  $request->validated();
        $invoice = $order->invoice;
        Mail::to($validatedRequest['email'])->send(new SendReceipt($invoice));

        return $this->success(['message'=> 'receipt.send']);
    }
}
