<?php

namespace App\Transformers;

use App\Entities\ApiAuth;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'title'   => trans('main.color'),
            'value'   => $this->title,
            'color'   => $this->color,
            'key'     => 'color',
        ];
    }
}
