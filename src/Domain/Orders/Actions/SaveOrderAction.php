<?php

namespace Domain\Orders\Actions;

use App\Models\Order;
use App\Models\OrderLineItem;
use Domain\Orders\DataTransferObjects\MakeOrderLineItemsData;
use Illuminate\Support\Facades\Auth;

class SaveOrderAction
{


    public function __invoke(int $orderNumber, MakeOrderLineItemsData $makeOrderLineItemsData): Order
    {
        $order = Order::create([
            'number' => $orderNumber,
            'user_id' => Auth::id()
        ]);
        foreach ($makeOrderLineItemsData->orderLineItemsData as $orderLineItem) {
            OrderLineItem::create([
                'product_id' => $orderLineItem->productId,
                'order_id' => $order->id,
                'amount' => $orderLineItem->amount,
                'price' => $orderLineItem->price,
            ]);
        }

        return $order;
    }
}
