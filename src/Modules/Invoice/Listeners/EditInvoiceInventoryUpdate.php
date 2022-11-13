<?php

namespace Modules\Invoice\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Invoice\Entities\InvoiceItem;
use Modules\Invoice\Events\EditInvoiceEvent;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Product\Entities\Product;

class EditInvoiceInventoryUpdate
{


    public function handle(EditRollbackInvoiceEvent $event)
    {
        info(collect($event));
//        $items = $event->invoice->invoiceItem()->get();
//
//        foreach ($items as $item) {
//
//            //TODO As we know should sum incomplete invoice item
////
//            $sumInventory = InvoiceItem::query()->where('product_id', $item->product_id)->sum('quantity');
//
//            $item->product()->de('inventory', $sumInventory);
//        }

    }
}
