<?php namespace App\Repositories;

use App\Entities\Brand;
use App\Transformers\BrandResource;

class BrandRepository {

    protected $model;
    public function __construct(Brand $model){
        $this->model = $model;
    }

    public function getBrands(){
        $brands = $this->model->active()->NotDeleted()->orderBy('id','desc')->get();
        $dataList = BrandResource::collection($brands);
        return $dataList;
    }

    public function getBrand($id){
        return $this->model->active()->NotDeleted()->find($id);
    }
}
