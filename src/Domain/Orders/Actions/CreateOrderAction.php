<?php

namespace Domain\Orders\Actions;

use App\Models\Order;
use App\Models\UniqueNumber;
use Domain\Orders\DataTransferObjects\MakeOrderLineItemsData;

class CreateOrderAction
{
    private DetermineOrderNumberAction $determineOrderNumberAction;
    private SaveOrderAction $saveOrderAction;

    public function __construct(DetermineOrderNumberAction $determineOrderNumberAction, SaveOrderAction $saveOrderAction)
    {
        $this->determineOrderNumberAction = $determineOrderNumberAction;
        $this->saveOrderAction = $saveOrderAction;
    }

    public function __invoke(MakeOrderLineItemsData $makeOrderLineItemsData): Order
    {
        $orderNumber = UniqueNumber::generateNumber('order');
        return ($this->saveOrderAction)($orderNumber, $makeOrderLineItemsData);
    }
}
