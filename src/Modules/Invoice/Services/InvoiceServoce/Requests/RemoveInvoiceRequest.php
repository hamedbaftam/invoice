<?php

namespace Modules\Invoice\Services\InvoiceServoce\Requests;

use Modules\Invoice\Entities\Invoice;

class RemoveInvoiceRequest
{
    public function __construct(public Invoice $invoice)
    {
    }
}
