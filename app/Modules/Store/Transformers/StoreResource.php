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
            'title_ar'   => $this->title_ar,
            'title_en'   => $this->title_en,
            'description_ar'   => $this->description_ar,
            'description_en'   => $this->description_en,
            'seller_id'   => $this->seller_id,
            'image'   => $this->image,
            'state_id'   => $this->state_id,
            'address'   => $this->address,
            'address_ar'   => $this->address_ar,
            'address_en'   => $this->address_en,
            'contact_info'   => $this->contact_info,
            'title'   => $this->title,
            'description'   => $this->description,
            'image_url'   => $this->image_url,
            'seller_name'   => $this->seller_name,
            'state_name'   => $this->state_name,
            'city_name'   => $this->city_name,
            'country_name'   => $this->country_name,
            'off_days'   => $this->off_days,
            'work_from'   => $this->work_from,
            'work_to'   => $this->work_to,
        
            'status' => $this->status,
            'statusText' => $this->status ? trans('Role::role.form.active') : trans('Role::role.form.notActive'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
