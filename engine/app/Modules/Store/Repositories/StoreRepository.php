<?php

namespace App\Repositories;

use App\Entities\Store;
use App\Transformers\StoreResource;

class StoreRepository {

    public function filterStores($request){
        $input = \Request::all();
        $source =  Store::active()->NotDeleted();
        if(isset($input['state_id']) && !empty($input['state_id'])){
            $source->whereStateId($input['state_id']);
        }
        if(isset($input['government_id']) && !empty($input['government_id'])){
            $source->whereHas('State',function($stateQuery) use ($input){
                $stateQuery->where('city_id',$input['government_id']);
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

    public function getStore($id){
        return Store::active()->NotDeleted()->with('Cars')->find($id);
    }

}
