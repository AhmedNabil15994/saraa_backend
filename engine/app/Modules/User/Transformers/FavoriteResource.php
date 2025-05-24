<?php

namespace App\Transformers;

use App\Transformers\CarResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->when($this->relationLoaded('Car'), function (){
            return new CarResource($this->Car);
        });
    }
}
