<?php

namespace Domain\Invoices\Actions;

use App\Models\Invoice;
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
        $invoiceNumber = ($this->determineInvoiceNumberAction)();
        return Invoice::create([
            'number' => $invoiceNumber,
            'user_id' => Auth::id(),
            'order_id' => $orderId
        ]);
    }
}
