<?php

namespace Domain\Invoices\Actions;

use App\Models\Invoice;
use App\Models\UniqueNumber;
use Illuminate\Support\Facades\Auth;

class CreateInvoiceAction
{


    public function __invoke(string $orderId): Invoice
    {
        $userUniqueNumber = Auth::user()->unique_number;
        $invoiceNumber = UniqueNumber::generateNumber('invoice',$userUniqueNumber);
        return Invoice::create([
            'number' => $invoiceNumber,
            'user_id' => Auth::id(),
            'order_id' => $orderId
        ]);
    }
}
