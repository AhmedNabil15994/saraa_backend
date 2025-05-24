<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'page_id'   => $this->page_id,
            'image'   => $this->image,
            'status'   => $this->status,
            'page_name' => $this->page_name,
        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
