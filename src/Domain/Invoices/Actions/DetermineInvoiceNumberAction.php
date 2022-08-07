<?php

namespace Domain\Invoices\Actions;

use Illuminate\Support\Facades\Auth;

class DetermineInvoiceNumberAction
{
    public function __invoke(): int
    {
        $invoices = Auth::user()->invoices();
        if (!$invoices) {
            return 1;
        }
        return Auth::user()->invoices()->max('number') + 1;
    }
}
