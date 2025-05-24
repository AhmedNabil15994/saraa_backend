<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'role_name' => $this->role_name,
            'email'   => $this->email,
            'password'   => $this->password,
            'remember_token'   => $this->remember_token,
            'mobile'   => $this->mobile,
            'extra_permissions'   => $this->extra_permissions,
            'role_id'   => $this->role_id,
            'last_login'   => $this->last_login != null ? date('d-m-Y h:i A', strtotime($this->last_login)) : '',
            'image'   => $this->image,
            'image_url'   => $this->image_url,
            'status'   => $this->status,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
