<?php

namespace App\Repositories;

use App\Entities\State;
use App\Entities\City;
use App\Transformers\StateResource;
use App\Transformers\CityResource;

class StateRepository {

    public function getStates(){
        $states = State::active()->NotDeleted()->orderBy('id','desc')->get();
        $dataList = StateResource::collection($states);
        return $dataList;
    }

    public function getState($id){
        return State::active()->NotDeleted()->find($id);
    }

    public function getCities(){
        return CityResource::collection(City::active()->get());
    }
}
