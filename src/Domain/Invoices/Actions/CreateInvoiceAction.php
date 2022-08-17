<?php

namespace Domain\Invoices\Actions;

use App\Models\Invoice;
use App\Models\UniqueNumber;
use Illuminate\Support\Facades\Auth;

class CreateInvoiceAction
{
    private DetermineInvoiceNumberAction $determineInvoiceNumberAction;

    public function __construct(DetermineInvoiceNumberAction $determineInvoiceNumberAction)
    {
        $this->determineInvoiceNumberAction = $determineInvoiceNumberAction;
    }

    public function __invoke(string $orderId): Invoice
    {
        $invoiceNumber = UniqueNumber::generateNumber('Invoice');
        return Invoice::create([
            'number' => $invoiceNumber,
            'user_id' => Auth::id(),
            'order_id' => $orderId
        ]);
    }
}
