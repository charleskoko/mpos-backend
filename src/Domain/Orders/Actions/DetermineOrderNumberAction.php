<?php

namespace Domain\Orders\Actions;

use Illuminate\Support\Facades\Auth;

class DetermineOrderNumberAction
{
    public function __invoke(): int
    {
        $orders = Auth::user()->orders();
        if (!$orders) {
            return 1;
        }
        return Auth::user()->orders()->max('number') + 1;
    }
}
