<?php

namespace Domain\Invoices\Actions;

use Illuminate\Support\Facades\Auth;

class DetermineInvoiceNumberAction
{
    public function __invoke(): int
    {
        $latestInvoice = Auth::user()->invoices()->orderBy('created_at', 'DESC')->first();
        if ($latestInvoice == null) {
            return 1;
        }
        return $latestInvoice->number + 1;
    }
}
