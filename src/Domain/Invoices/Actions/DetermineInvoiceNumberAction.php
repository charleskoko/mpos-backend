<?php

namespace Domain\Invoices\Actions;

use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class DetermineInvoiceNumberAction
{
    public function __invoke(): int
    {
        $invoices = Invoice::where('user_id','=',Auth::id());
        if (!$invoices) {
            return 1;
        }
        return Auth::user()->invoices()->max('number') + 1;
    }
}
