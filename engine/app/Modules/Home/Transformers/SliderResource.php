<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'description' => $this->description,
            'image_url'   => $this->image_url,
        ];
    }
}
