<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\Category as Model;
use App\Http\Requests\CategoryValidator as ModelValidator;

class EloquentCategoryRepository implements EntityRepositoryInterface {

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
        if(isset($input['parent_id']) && !empty($input['parent_id'])){
            $source = $source->where('parent_id',$input['parent_id']);
        }
        if(isset($input['status']) && !empty($input['status'])){
            $source = $source;
        }else{
            $source = $source->where('status',1);
        }
        if(isset($input['name_ar']) && !empty($input['name_ar'])){
            $source = $source->where('name_ar','LIKE','%'.$input['name_ar'].'%');
        }
        if(isset($input['name_en']) && !empty($input['name_en'])){
            $source = $source->where('name_en','LIKE','%'.$input['name_en'].'%');
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
        $return = $this->model->create($createData);
        if($request->hasFile('image')){
            $image = \FilesHelper::uploadFile('categories',$request->file('image'),$return->id);
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

        $validator = $this->createValidator->with($request->all())->passes();
        if(!$validator){
            $this->errors = $this->createValidator->errors();
            return false;
        }
        $updateData= $validator->validated();
        if(!isset($updateData['status'])){
            $updateData['status'] = 0;
        }
        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('categories',$request->file('image'),$id);
        }
        return $record->update($updateData);
    }

    public function delete($id) {
        $record = $this->getById($id);
        if(!$record){
            return false;
        }

        if ($record->trashed()){
            \FilesHelper::deleteDirectory(public_path('/').'/uploads/categories/'.$id);
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
