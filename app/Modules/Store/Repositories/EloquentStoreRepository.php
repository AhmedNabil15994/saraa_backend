<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\Store as Model;
use App\Http\Requests\StoreValidator as ModelValidator;

class EloquentStoreRepository implements EntityRepositoryInterface {

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
        if(isset($input['state_id']) && !empty($input['state_id'])){
            $source = $source->where('state_id',$input['state_id']);
        } 
        if(isset($input['city_id']) && !empty($input['city_id'])){
            $source = $source->whereHas('State',function($whereHas) use ($input){
                $whereHas->where('city_id',$input['city_id']);
            });
        }        
        if(isset($input['status']) && !empty($input['status'])){
            $source = $source;
        }else{
            $source = $source->where('status',1);
        }
        if(isset($input['title_ar']) && !empty($input['title_ar'])){
            $source = $source->where('title_ar','LIKE','%'.$input['title_ar'].'%');
        }
        if(isset($input['title_en']) && !empty($input['title_en'])){
            $source = $source->where('title_en','LIKE','%'.$input['title_en'].'%');
        }
        if(isset($input['seller']) && !empty($input['seller'])){
            $source = $source->where('seller',$input['seller']);
        } 
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $source = $source->where([
                ['created_at' , '>=' , date('Y-m-d H:i:s',strtotime($input['from'] . " 00:00:00"))],
                ['created_at' , '<=' , date('Y-m-d H:i:s',strtotime($input['to'] . " 23:59:59"))],
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
        $createData = $validator->validated();
        if(isset($createData['contact_info']) && !empty($createData['contact_info'])){
            $createData['contact_info'] = json_encode($createData['contact_info']);
        }
        $return = $this->model->create($createData);
        foreach ($request->emp_ids as $value) {
            $return->EmployeeStores()->create(['emp_id'=>$value]);
        }
        if($request->hasFile('image')){
            $image = \FilesHelper::uploadFile('stores',$request->file('image'),$return->id);
            $return->update(['image'=>$image]);
        }
        return $return;
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

        $validator = $this->createValidator->with($request->all(),$id)->passes();
        if(!$validator){
            $this->errors = $this->createValidator->errors();
            return false;
        }

        $updateData = $validator->validated();
        if(isset($createData['contact_info']) && !empty($createData['contact_info'])){
            $createData['contact_info'] = array_unique(array_merge( json_encode($createData['contact_info']) , json_decode($record->contact_info)));
        }
        $record->EmployeeStores()->delete();
        if(isset($updateData['emp_ids'])){
            if(count($updateData['emp_ids']) > 0){
                foreach ($updateData['emp_ids'] as $key => $emp_id) {
                    $record->EmployeeStores()->create(['emp_id'=>$emp_id]);
                }
            }
        }
        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('stores',$request->file('image'),$id);
        }
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

    public function upload($request,$id){
        $record = $this->getById($id);
        if(!$record){
            return false;
        }

        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('stores',$request->file('image'),$id);
        }
        return $record->update($updateData);
    }
}
