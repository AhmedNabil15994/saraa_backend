<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'store_id'   => $this->store_id,
            'color_arr'   => $this->color_arr ,
            'type_arr'   => $this->type_arr ,
            'brand_id'   => $this->brand_id,
            'model_id'   => $this->model_id,
            'year'   => $this->year,
            'prices_arr'   => $this->prices_arr,
            'available_from'   => $this->available_from,
            'available_to'   => $this->available_to,
            'image'   => $this->image,
            'attachments'   => $this->attachments,
            'image_url'   => $this->image_url,
            'title'   => $this->title,
            'description'   => $this->description,
            'brand_name'   => $this->brand_name,
            'store_name'   => $this->store_name,
            'model_name'   => $this->model_name,
            'is_monthly'   => $this->is_monthly ? true : false,
            'seller_name' => $this->seller_name,
            'attachments_url' => $this->attachments_url,
        
            'status' => $this->status,
            'statusText' => $this->status ? trans('Role::role.form.active') : trans('Role::role.form.notActive'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
