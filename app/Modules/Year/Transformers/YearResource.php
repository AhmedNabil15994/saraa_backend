<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class YearResource extends JsonResource
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
        
            'status' => $this->status,
            'statusText' => $this->status ? trans('Role::role.form.active') : trans('Role::role.form.notActive'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
