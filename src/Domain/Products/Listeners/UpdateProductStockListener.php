<?php

namespace Domain\Products\Listeners;

use Domain\Products\Actions\UpdateProductStockAction;
use Domain\Products\Events\UpdateProductStockEvent;

class UpdateProductStockListener
{
    private UpdateProductStockAction $updateProductStockAction;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UpdateProductStockAction $updateProductStockAction)
    {
        $this->updateProductStockAction = $updateProductStockAction;
    }

    /**
     * Handle the event.
     *
     * @param UpdateProductStockEvent $event
     * @return void
     */
    public function handle(UpdateProductStockEvent $event)
    {
        ($this->updateProductStockAction)($event->order->orderLineItems);
    }
}
