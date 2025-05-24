<?php

namespace App\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Reservation\Enums\ReservationStatus;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $status = 'STATUS_'.$this->status;
        return [
            'id' => $this->id,
            'store_id'   => $this->store_id,
            'car_id'   => $this->car_id,
            'client_id'   => $this->client_id,
            'reserve_from'   => $this->reserve_from,
            'reserve_to'   => $this->reserve_to,
            'price'   => $this->price,
            'transaction_id'   => $this->transaction_id ?? '',

            'store_name'   => $this->store_name,
            'car_name'   => $this->car_name,
            'client_name'   => $this->client_name,
            'seller_name'   => $this->seller_name,
            'discount_price'   => $this->discount_price,
        
            'statusText' => ReservationStatus::$status()->getValue() ,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
