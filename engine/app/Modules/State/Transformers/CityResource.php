<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'country_name'   => $this->country_name,
            'country_id'   => $this->country_id,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
            'states' => StateResource::collection($this->states),
        ];
    }
}
