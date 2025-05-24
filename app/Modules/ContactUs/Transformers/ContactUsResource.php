<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactUsResource extends JsonResource
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
            'name'   => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'message'   => $this->message,
            'status'   => $this->status,
        
            'created_at'   => date('d-m-Y h:i A', strtotime($this->created_at)),
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
