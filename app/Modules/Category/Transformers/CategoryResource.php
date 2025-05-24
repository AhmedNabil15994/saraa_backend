<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'name_ar'   => $this->name_ar,
            'parent_name' => $this->parent_name,
            'name_en'   => $this->name_en,
            'parent_id'   => $this->parent_id,
            'status'   => $this->status,
            'image'   => $this->image,
            'name'   => $this->name,
        
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
