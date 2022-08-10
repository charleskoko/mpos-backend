<?php

namespace Domain\Invoices\Actions;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DetermineInvoiceNumberAction
{
    public function __invoke(): int
    {
        $invoices = Auth::user()->invoices();
        if (!$invoices) {
            return 1;
        }
        return Invoice::where('user_id','=',Auth::id())->max('number') + 1;
    }
}
