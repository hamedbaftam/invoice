<?php

namespace Modules\Invoice\Services\InvoiceServoce\Responses;

use Modules\Invoice\Entities\Invoice;

class NewInvoiceResponse
{
//    public int $totalAmount;
//    public $items;

    public function __construct(public $customer, public Invoice $invoice, public $items)
    {
    }


}
