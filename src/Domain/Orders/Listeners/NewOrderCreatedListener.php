<?php

namespace Domain\Orders\Listeners;

use Domain\Invoices\Actions\CreateInvoiceAction;
use Domain\Orders\Events\NewOrderCreatedEvent;

class NewOrderCreatedListener
{
    private CreateInvoiceAction $createInvoiceAction;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(CreateInvoiceAction $createInvoiceAction)
    {
        $this->createInvoiceAction = $createInvoiceAction;
    }

    /**
     * Handle the event.
     *
     * @param NewOrderCreatedEvent $event
     * @return void
     */
    public function handle(NewOrderCreatedEvent $event)
    {
        ($this->createInvoiceAction)($event->order->id);
    }
}
