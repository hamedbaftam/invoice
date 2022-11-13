<?php

namespace Modules\Invoice\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Invoice\Events\NewInvoiceEvent;

class NewInvoiceInventoryUpdate
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(NewInvoiceEvent $event)
    {
        $items = $event->invoice->invoiceItem()->get();

        foreach ($items as $item) {
            $item->product()->decrement('inventory', $item->quantity);
        }

    }
}
