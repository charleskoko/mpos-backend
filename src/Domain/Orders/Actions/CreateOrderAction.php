<?php

namespace Domain\Orders\Actions;

use App\Models\Order;
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
        $orderNumber = ($this->determineOrderNumberAction)();
        return ($this->saveOrderAction)($orderNumber, $makeOrderLineItemsData);
    }
}
