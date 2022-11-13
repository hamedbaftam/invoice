<?php

namespace Modules\Customer\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Invoice\Transformers\InvoiceItemResource;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(callback: function ($item) {
            return new CustomerResource($item);
        });
    }
}
