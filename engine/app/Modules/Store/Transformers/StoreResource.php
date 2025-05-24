<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title'   => $this->title,
            'description'   => $this->description,
            'seller_id'   => $this->seller_id,
            'seller_name'   => $this->seller_name,
            'city_name'   => $this->city_name,
            'city_id'   => $this->State->city_id,
            'country_name'   => $this->country_name,
            'state_id'   => $this->state_id,
            'state_name'   => $this->state_name,
            'address'   => $this->address,
            'contact_info'   => $this->off_days != null ? json_decode($this->contact_info) : [],
            'image_url'   => $this->image_url,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
        ];
    }
}
