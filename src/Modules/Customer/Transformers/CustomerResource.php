<?php

namespace Modules\Customer\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $item = $this->resource;
        return [
            'id' => $item->id,
            'demonstrationName' => $item->demonstration_name,
            'active' => $item->active,
            'firstName' => $item->first_name,
            'lastName' => $item->last_name,
            'socialId' => $item->social_id,
            'birthday' => $item->birthday,
            'mobileNumber' => $item->mobile_number,
            'mobileNumberDescription' => $item->mobile_number_description,
            'email' => $item->email,
            'emailDescription' => $item->email_description,
        ];
    }
}
