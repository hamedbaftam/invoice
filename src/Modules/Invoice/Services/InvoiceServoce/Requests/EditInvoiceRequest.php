<?php

namespace Modules\Invoice\Services\InvoiceServoce\Requests;

class EditInvoiceRequest
{
    public function __construct(public int $invoice, public array $products)
    {
    }
}
