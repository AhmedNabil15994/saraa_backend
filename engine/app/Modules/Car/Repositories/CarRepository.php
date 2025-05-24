<?php namespace App\Repositories;

use App\Entities\Car;
use App\Transformers\CarResource;

class CarRepository {

    protected $model;
    public function __construct(Car $model){
        $this->model = $model;
    }

    public function filterCars(){
        $input = \Request::all();
        $source =  $this->model->active()->NotDeleted();
        if(isset($input['search']) && !empty($input['search'])){
            $source->where(function($query) use ($input){
                $query->where("title_en","like","%{$input['search']}%");
                $query->orWhere("title_ar","like","%{$input['search']}%");
                $query->orWhere("description_en","like","%{$input['search']}%");
                $query->orWhere("description_ar","like","%{$input['search']}%");
            });
        }
        if(isset($input['brand_id']) && !empty($input['brand_id'])){
            $source->whereBrandId($input['brand_id']);
        }
        if(isset($input['model_id']) && !empty($input['model_id'])){
            $source->whereModelId($input['model_id']);
        }
        if(isset($input['color']) && !empty($input['color'])){
            $source->whereColor($input['color']);
        }
        if(isset($input['is_daily']) && $input['is_daily'] != null){
            $source->whereIsDaily($input['is_daily']);
        }
        if(isset($input['is_monthly']) && $input['is_monthly'] != null){
            $source->whereIsMonthly($input['is_monthly']);
        }
        if(isset($input['color']) && !empty($input['color'])){
            $source->whereColor($input['color']);
        }
        if(isset($input['type']) && !empty($input['type'])){
            $source->whereType($input['type']);
        }
        if(isset($input['store_id']) && !empty($input['store_id'])){
            $source->whereStoreId($input['store_id']);
        }
        if(isset($input['government_id']) && !empty($input['government_id'])){
            $source->whereHas('Store',function($storeQuery) use ($input){
                $storeQuery->whereHas('State',function($stateQuery) use ($input){
                    $stateQuery->where('city_id',$input['government_id']);
                });
            });
        }
        if(isset($input['price_from']) && !empty($input['price_from']) && isset($input['price_to']) && !empty($input['price_to'])){
            $source->where([
                ['price','>=',$input['price_from']],
                ['price','<=',$input['price_to']],
            ]);
        }
        if(isset($input['available_from']) && !empty($input['available_from']) && isset($input['available_to']) && !empty($input['available_to'])){
            $source->whereDoesntHave('Reservations',function($whereQuery) use ($input){
                $whereQuery->where('status','>',0)->where(function($reserveQuery) use($input){
                    $from = $input['available_from'] . ' 00:00:00';
                    $to = $input['available_to'] . ' 12:00:00';
                    $reserveQuery->whereBetween('reserve_from',[$from,$to])
                        ->orWhereBetween('reserve_to',[$from,$to]);
                });
            });
        }

        if(isset($input['latest']) && !empty($input['latest'])){
            $source->orderBy('id','DESC');
        }else{
            $source->orderBy('id','ASC');
        }

        $sourceArr = $source->paginate($request->per_page??10);
        return $sourceArr;
    }

    public function getCar($id){
        $id = (int) $id;
        $car = $this->model->active()->NotDeleted()->find($id);
        return $car ? $car : \TraitsFunc::error(trans('main.notFound'));
    }
}
