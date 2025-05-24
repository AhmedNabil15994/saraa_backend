<?php

namespace App\Transformers;

use App\Entities\ApiAuth;
use App\Transformers\CarTypeResource;
use App\Transformers\ColorResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = [

            ['key' => 'year'  ,'title' => trans('main.year') ,'value'=> $this->year],
            ['key' => 'model' ,'title' => trans('main.model') ,'value'=> $this->model_name],
            ['key' => 'brand' ,'title' => trans('main.brand') ,'value'=> $this->brand_name],
        ];
        if($this->Color){
            $attributes[]= new ColorResource($this->Color);
        }
        if($this->CarType){
            $attributes[]= new CarTypeResource($this->CarType);
        }

        $base =  [
            'id' => $this->id,
            'title'   => $this->title,
            'description'   => strip_tags($this->description),
            'year'   => $this->year,
            'prices'   => $this->prices_arr,
            'price_label' => $this->prices_arr[0] ? round( ($this->prices_arr[0]->price / $this->prices_arr[0]->duration) ,2) . ' ' . trans('main.currency') .' ' . trans('main.per_day')  : '',
            'color'   => new ColorResource($this->Color),
            'type'   => new CarTypeResource($this->CarType),
            'image_url'   => $this->image_url,
            'is_monthly'   => $this->is_monthly ? true : false,
            'is_daily'   => $this->is_daily ? true : false,
            'attachments_url'   => $this->attachments_url,
            'status' => $this->status ? trans('main.active') : trans('main.notActive'),
            'is_favorite' => null,
            'store' => [
                'id' => (int)$this->store_id,
                'state_name' => $this->store->state_name,
                'city_name' => $this->store->state->city_name,
                'country_name' => $this->store->state->city->country_name,
                'title' => $this->store_name,
                'image_url' => $this->store->image_url,
            ],
            'brand' => [
                'id' => (int)$this->brand_id,
                'title' => $this->brand_name,
            ],
            'model' => [
                'id' => (int)$this->model_id,
                'title' => $this->model_name,
            ],
            'attributes' => $attributes,
        ];

        $favs = [];
        if(request()->bearerToken()){
            $checkAuth = ApiAuth::checkUserToken(request()->bearerToken());
            if($checkAuth){
                $favs = \App\Entities\Favorite::where('user_id',$checkAuth['user']->id)->pluck('car_id');
                $favs = !empty($favs)  ? reset($favs) : $favs;
                $base['is_favorite'] = in_array($this->id,$favs);
            }
        }

        return $base;
    }
}
