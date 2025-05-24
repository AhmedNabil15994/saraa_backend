<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name'   => $this->name,
            'image'   => $this->image_url,
            'email'   => $this->email,
            'mobile'   => str_replace($this->calling_code,'',$this->mobile),
            'calling_code'   => $this->calling_code,
            'is_active'   => $this->status ? true : false,
            'is_verified'   => $this->is_verified ? true : false,
            'last_login'   => date('d M, Y' ,strtotime($this->last_login)),
        ];
    }
}
