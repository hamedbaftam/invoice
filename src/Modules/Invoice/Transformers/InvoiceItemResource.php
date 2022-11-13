<?php

namespace Modules\Invoice\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $item = $this->resource;
        return [
            'quantity' => (int)$item->quantity,
            'price' => (int)$item->price,
            'amount' => (int)$item->amount,
            'discount' => (int)$item->discount,
            'totalAmountAfterDiscount' => (int)$item->total_after_discount,
            'tax' => (float)$item->tax,
            'totalAmount' => (int)$item->total_amount,
//            'quantity'=>$item->quantity,

        ];
    }
}
