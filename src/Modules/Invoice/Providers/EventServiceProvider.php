<?php

namespace Modules\Invoice\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Invoice\Events\EditInvoiceEvent;
use Modules\Invoice\Events\EditRollbackInvoiceEvent;
use Modules\Invoice\Events\NewInvoiceEvent;
use Modules\Invoice\Listeners\EditInvoiceInventoryRollbackUpdate;
use Modules\Invoice\Listeners\EditInvoiceInventoryUpdate;
use Modules\Invoice\Listeners\NewInvoiceInventoryUpdate;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        NewInvoiceEvent::class => [
            NewInvoiceInventoryUpdate::class
        ],
//        EditInvoiceEvent::class => [
//            EditInvoiceInventoryUpdate::class
//        ],
        EditRollbackInvoiceEvent::class => [
            EditInvoiceInventoryRollbackUpdate::class
        ]
    ];
}
