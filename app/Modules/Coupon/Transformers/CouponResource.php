<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'code'   => $this->code,
            'discount_type'   => $this->discount_type,
            'discount_value'   => $this->discount_value,
            'valid_until'   => $this->valid_until,
            'discount_type_text' => $this->discount_type_text,
            'valid_type' => $this->valid_type,
            'store_id' => $this->store_id,
            'store_name' => $this->store_name,
            'status' => $this->status,
            'statusText' => $this->status ? trans('Role::role.form.active') : trans('Role::role.form.notActive'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
