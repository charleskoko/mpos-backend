<?php

namespace Domain\Products\Actions;


use Illuminate\Database\Eloquent\Collection;

class UpdateProductStockAction
{
    /**
     * @param Collection $orderItems
     */
    public function __invoke(Collection $orderItems)
    {
        foreach ($orderItems as $orderItem) {
            $orderItem->product->update(['stock' => $orderItem->product->stock - $orderItem->amount]);
        }
    }


}
