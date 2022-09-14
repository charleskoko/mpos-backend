<?php

namespace Domain\Orders\Actions;

use App\Models\Order;
use App\Models\UniqueNumber;
use Domain\Orders\DataTransferObjects\MakeOrderLineItemsData;
use Illuminate\Support\Facades\Auth;

class CreateOrderAction
{
    private SaveOrderAction $saveOrderAction;

    public function __construct(SaveOrderAction $saveOrderAction)
    {
        $this->saveOrderAction = $saveOrderAction;
    }

    public function __invoke(MakeOrderLineItemsData $makeOrderLineItemsData): Order
    {
        $userUniqueNumber = Auth::user()->unique_number;
        $orderNumber = UniqueNumber::generateNumber('order',$userUniqueNumber, Auth::id());
        return ($this->saveOrderAction)($orderNumber, $makeOrderLineItemsData);
    }
}
