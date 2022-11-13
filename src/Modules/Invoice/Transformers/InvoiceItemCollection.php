<?php

namespace Modules\Invoice\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(callback: function ($item) {
            return new InvoiceItemResource($item);
        });
    }
}
