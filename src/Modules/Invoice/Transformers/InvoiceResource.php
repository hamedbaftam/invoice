<?php

namespace Modules\Invoice\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Customer\Transformers\CustomerResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray($request)
    {
        return [
            'customer' => new CustomerResource($this->resource->customer),
            'items' => new InvoiceItemCollection($this->resource->items),
            'totalAmount' => $this->resource->invoice->totalAmount,
            'invoiceId' => $this->resource->invoice->id,
        ];
    }
}
