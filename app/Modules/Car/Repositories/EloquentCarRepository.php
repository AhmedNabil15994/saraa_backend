<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\Car as Model;
use App\Http\Requests\CarValidator as ModelValidator;

class EloquentCarRepository implements EntityRepositoryInterface {

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
        if(isset($input['store_id']) && !empty($input['store_id'])){
            $source = $source->where('store_id',$input['store_id']);
        }
        if(isset($input['year']) && !empty($input['year'])){
            $source = $source->where('year',$input['year']);
        }
        if(isset($input['color']) && !empty($input['color'])){
            $source = $source->where('color',$input['color']);
        }
        if(isset($input['type']) && !empty($input['type'])){
            $source = $source->where('type',$input['type']);
        }
        if(isset($input['brand_id']) && !empty($input['brand_id'])){
            $source = $source->where('brand_id',$input['brand_id']);
        }
        if(isset($input['model_id']) && !empty($input['model_id'])){
            $source = $source->where('model_id',$input['model_id']);
        }
        if(isset($input['seller_id']) && !empty($input['seller_id'])){
            $source = $source->whereHas('store',function($whereHas) use ($input){
                $whereHas->where('seller_id',$input['seller_id']);
            });
        }
        if(isset($input['status']) && !empty($input['status'])){
            $source = $source;
        }else{
            $source = $source->where('status',1);
        }
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $source = $source->where([
                ['available_from' , '>=' , date('Y-m-d H:i:s',strtotime($input['from'] . " 00:00:00"))],
                ['available_to' , '<=' , date('Y-m-d H:i:s',strtotime($input['to'] . " 23:59:59"))],
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
        if(isset($createData['tags']) && !empty($createData['tags'])){
            $createData['is_daily'] = in_array('is_daily',$createData['tags']);
            $createData['is_monthly'] = in_array('is_monthly',$createData['tags']);
            unset($createData['tags']);
        }
        $return = $this->model->create($createData);
        if($request->hasFile('image')){
            $image = \FilesHelper::uploadFile('cars',$request->file('image'),$return->id);
            $return->update(['image'=>$image]);
        }
        if(isset($createData['type'])){
            $createData['type'] = (int) $createData['type'];
        }
        if(isset($createData['color'])){
            $createData['color'] = (int)  $createData['color'];
        }
        if($request->hasFile('attachments')){
            $imagesArr = [];
            foreach ($request->file('attachments') as $key => $value) {
                $imagesArr[] = \FilesHelper::uploadFile('cars',$value,$return->id);
            }
            $return->update(['attachments'=>serialize($imagesArr)]);
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
        if(isset($updateData['tags']) && !empty($updateData['tags'])){
            $updateData['is_daily'] = in_array('is_daily',$updateData['tags']);
            $updateData['is_monthly'] = in_array('is_monthly',$updateData['tags']);
            unset($updateData['tags']);
        }
        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('cars',$request->file('image'),$id);
        }
        if(!isset($updateData['status'])){
            $updateData['status'] = 0;
        }
        if(!isset($updateData['is_monthly'])){
            $updateData['is_monthly'] = 0;
        }
        if(isset($updateData['type'])){
            $updateData['type'] = (int) $updateData['type'];
        }
        if(isset($updateData['color'])){
            $updateData['color'] = (int)  $updateData['color'];
        }
        if($request->hasFile('attachments')){
            $imagesArr = [];
            foreach ($request->file('attachments') as $key => $value) {
                $imagesArr[] = \FilesHelper::uploadFile('cars',$value,$record->id);
            }
            $record->update(['attachments'=>serialize($imagesArr)]);
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
            $updateData['image'] = \FilesHelper::uploadFile('cars',$request->file('image'),$id);
        }
        return $record->update($updateData);
    }
}
