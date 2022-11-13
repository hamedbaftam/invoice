<?php

namespace Modules\Invoice\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Product\Entities\Product;

class EditInvoiceInventoryRollbackUpdate
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
     * @param  object  $event
     * @return void
     */
    public function handle(EditRollbackInvoiceEvent $event)
    {
        Product::query()->findOrFail($event->invoiceItem['product_id'])->increment('inventory',$event->invoiceItem['quantity']);
    }
}
