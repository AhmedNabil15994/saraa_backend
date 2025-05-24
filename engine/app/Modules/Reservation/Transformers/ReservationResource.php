<?php

namespace App\Transformers;

use App\Transformers\CarResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
        $car = $this->Car ? $this->when($this->relationLoaded('Car'), function (){
            return new CarResource($this->Car);
        }) : null;

        return [
            'id' => $this->id,
            'store_id'   => $this->store_id,
            'car_id'   => $this->car_id,
            'client_id'   => $this->client_id,
            'reserve_from'   => date('d M, Y' ,strtotime($this->reserve_from)),
            'reserve_from_day'   => trans('main.'.lcfirst(date('D' ,strtotime($this->reserve_from)))),
            'reserve_to'   => date('d M, Y' ,strtotime($this->reserve_to)),
            'reserve_to_day'   => trans('main.'.lcfirst(date('D' ,strtotime($this->reserve_to)))),
            'price'   => (string)$this->price,

            'store_name'   => $this->store_name,
            'car_name'   => $this->car_name,
            'client_name'   => $this->client_name,
            'seller_name'   => $this->seller_name,
            'brand_name'   => $this->Car && $this->Car->brand_name != '' ? $this->Car->brand_name : '',
            'model_name'   => $this->Car && $this->Car->model_name != '' ? $this->Car->model_name : '',
            'discount_price'   => $this->discount_price,
            'files_url'   => $this->files_url,
            'delievered' => $this->status && $this->reserve_to <= date('Y-m-d H:i:s') ? true : false,
            'status' => $this->status ? ($this->status == 1 ? 'Paid' : 'Pending') : trans('main.notActive'),
            'car' => $car,
            'created_at' => date('d M, Y' ,strtotime($this->created_at)),
            'payment_url'   => $this->payment_url ?? '',
            'updated_at' => $this->status != 2 ? date('d M, Y' ,strtotime($this->updated_at )): '',
            'address' => $this->address
        ];
    }
}
