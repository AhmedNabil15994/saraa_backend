<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'date'   => date('d-m-Y h:i A', strtotime($this->date)),
            'status'   => $this->status,
            'image'   => $this->image,
            'image_url'   => $this->image_url,
            'category_id'   => $this->category_id,
            'category_name'   => $this->category_name,
            'views'   => $this->views,
            'title'   => $this->title,
            'description'   => $this->description,
        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
