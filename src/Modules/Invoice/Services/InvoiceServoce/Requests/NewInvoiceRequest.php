<?php

namespace Modules\Invoice\Services\InvoiceServoce\Requests;

class NewInvoiceRequest
{


    public function __construct(public int $customerId, public array $products)
    {
    }
}
