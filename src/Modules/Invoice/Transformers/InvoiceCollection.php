<?php

namespace Modules\Invoice\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceCollection extends ResourceCollection
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
            return [
                'customer' => $item->customer,
                'items' => new InvoiceItemCollection($item->invoiceItem),
                'totalAmount' => (int)$item->total_amount
            ];
        });
    }
}
