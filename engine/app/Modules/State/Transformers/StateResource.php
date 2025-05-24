<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
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
            'city_name'   => $this->city_name,
            'country_name'   => $this->country_name,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
        ];
    }
}
