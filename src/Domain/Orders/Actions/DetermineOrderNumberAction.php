<?php

namespace Domain\Orders\Actions;

use Illuminate\Support\Facades\Auth;

class DetermineOrderNumberAction
{
    public function __invoke(): int
    {
        $latestOrder = Auth::user()->orders()->orderBy('created_at', 'DESC')->first();
        if ($latestOrder == null) {
            return 1;
        }
        return $latestOrder->number + 1;
    }
}
