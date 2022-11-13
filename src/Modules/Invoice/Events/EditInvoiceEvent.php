<?php

namespace Modules\Invoice\Events;

use Illuminate\Queue\SerializesModels;
use Modules\Invoice\Entities\Invoice;

class EditInvoiceEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $invoice)
    {
        //
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
