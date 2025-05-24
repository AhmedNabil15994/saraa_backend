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
            'title_ar'   => $this->title_ar,
            'title_en'   => $this->title_en,
            'description_ar'   => $this->description_ar,
            'description_en'   => $this->description_en,
            'status'   => $this->status,
            'title'   => $this->title,
            'description'   => $this->description,
            'image'   => $this->image,
            'image_url'   => $this->image_url,
        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
