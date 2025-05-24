<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\Reservation as Model;
use App\Http\Requests\ReservationValidator as ModelValidator;

class EloquentReservationRepository implements EntityRepositoryInterface {

    protected $model;
    public $errors;
    protected $createValidator;

    public function __construct(Model $model,ModelValidator $createValidator) {
        $this->model = $model;
        $this->createValidator = $createValidator;
    }

    public function dataList($request){
        $source = $this->model;
        $input = $request->all();

        if(isset($input['deleted_at']) && !empty($input['deleted_at'])){
            $source = $source->onlyTrashed();
        }
        if(isset($input['id']) && !empty($input['id'])){
            $source = $source->where('id',$input['id']);
        }
        if(isset($input['transaction_id']) && !empty($input['transaction_id'])){
            $source = $source->where('transaction_id',$input['transaction_id']);
        }
        if(isset($input['price']) && !empty($input['price'])){
            $source = $source->where('price',$input['price']);
        } 
        if(isset($input['store_id']) && !empty($input['store_id'])){
            $source = $source->where('store_id',$input['store_id']);
        } 
        if(isset($input['seller_id']) && !empty($input['seller_id'])){
            $source = $source->whereHas('Store',function($whereHas) use($input){
                $whereHas->where('seller_id',$input['seller_id']);
            });
        }
        if(isset($input['brand_id']) && !empty($input['brand_id'])){
            $source = $source->whereHas('Car',function($whereHas) use($input){
                $whereHas->where('brand_id',$input['brand_id']);
            });
        }
        if(isset($input['model_id']) && !empty($input['model_id'])){
            $source = $source->whereHas('Car',function($whereHas) use($input){
                $whereHas->where('model_id',$input['model_id']);
            });
        }
        if(isset($input['year']) && !empty($input['year'])){
            $source = $source->whereHas('Car',function($whereHas) use($input){
                $whereHas->where('year',$input['year']);
            });
        }
        if(isset($input['state_id']) && !empty($input['state_id'])){
            $source = $source->whereHas('Store',function($whereHas) use($input){
                $whereHas->where('state_id',$input['state_id']);
            });
        }
        if(isset($input['client_id']) && !empty($input['client_id'])){
            $source = $source->where('client_id',$input['client_id']);
        } 
        if(isset($input['car_id']) && !empty($input['car_id'])){
            $source = $source->where('car_id',$input['car_id']);
        }        
        if(isset($input['status'])){
            $source = $source->where('status',$input['status']);
        }else{
            $source = $source;
        }
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $source = $source->where([
                ['reserve_from' , '>=' , date('Y-m-d H:i:s',strtotime($input['from'] . " 00:00:00"))],
                ['reserve_to' , '<=' , date('Y-m-d H:i:s',strtotime($input['to'] . " 23:59:59"))],
            ]);
        } 
        
        return $source->orderBy('id','DESC')->get();
    }
    
    public function getAll($request) {
        return $this->model->all();
    }

    public function create($request) {
        $validator = $this->createValidator->with($request->all())->passes();
        if(!$validator){
            $this->errors = $this->createValidator->errors();
            return false;
        }
        return $this->model->create($validator->validated());
    }

    public function getById($id) {
        $record = $this->model->withTrashed()->find($id);
        if(!$record){
            $this->errors = trans('Dashboard::dashboard.notExits');
            return false;
        }
        return $record;        
    }

    public function update($request,$id) {
        $record = $this->getById($id);
        if(!$record){
            return false;
        }

        $updateData = $request->all();
        if(!isset($updateData['status'])){
            $updateData['status'] = 0;
        }
        return $record->update($updateData);
    }

    public function delete($id) {
        $record = $this->getById($id);
        if(!$record){
            return false;
        }

        if ($record->trashed()){
            return $record->forceDelete();
        }else{
            return $record->delete();
        }
    }

    public function restoreSoftDelte($id)
    {
        $record = $this->getById($id);
        if(!$record){
            return false;
        }
        return $record->restore();        
    }

    public function quickEdit($request){
        $records = $request->data;
        if(is_array($records)){
            foreach ($records as $record) {
                $this->model->where('id',$record[0])->update([$record[1] => $record[2]]);
            }
            return true;
        }
        return false;
    }

    public function deleteManyById($request){
        $records = $request->data;
        if(is_array($records)){
            foreach ($records as $record) {
                $this->delete($record[0]);
            }
            return true;
        }
        return false;
    }
}
