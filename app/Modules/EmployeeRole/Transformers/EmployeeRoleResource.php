<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeRoleResource extends JsonResource
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
            'name_en'   => $this->name_en,
            'name'   => $this->name,
            'permissions'   => $this->permissions != null ? unserialize($this->permissions) : [],
            'status'   => $this->status,
            'created_at' => $this->created_at,
            'creator' => $this->creator_name,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
