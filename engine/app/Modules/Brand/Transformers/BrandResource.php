<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'image_url'   => $this->image_url,
            'title'   => $this->title,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
            'created_at' => date('d M, Y' ,strtotime($this->created_at)),
        ];
    }
}
