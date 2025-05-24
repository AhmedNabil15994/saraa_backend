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
            'title' => $this->title,
            'description' => $this->description,
            // 'image_url' => $this->image_url,
            'page_name' => $this->page_name,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
        ];
    }
}
