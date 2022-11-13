<?php

namespace Modules\Invoice\Events;

use Illuminate\Queue\SerializesModels;

class EditRollbackInvoiceEvent
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(public $invoiceItem)
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
