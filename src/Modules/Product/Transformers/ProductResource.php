<?php

namespace Modules\Product\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'itemName' => $item->item_name,
            'active' => $item->active,
            'sellingPrice' => (int)$item->selling_price,
            'tax' => (float)$item->tax,
            'discountPercentage' => (float)$item->discount_percentage,
            'inventory' => (float)$item->inventory,
        ];
    }
}
