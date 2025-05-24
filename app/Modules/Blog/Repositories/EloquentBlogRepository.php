<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\Blog as Model;
use App\Http\Requests\BlogValidator as ModelValidator;

class EloquentBlogRepository implements EntityRepositoryInterface {

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
            // if($input['deleted_at'] == '2'){
            //     $source = $source->onlyTrashed();
            // }else if($input['deleted_at'] == '1'){
                // $source = $source->withTrashed();
            // }
        }
        if(isset($input['id']) && !empty($input['id'])){
            $source = $source->where('id',$input['id']);
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
        if(isset($input['from']) && !empty($input['from']) && isset($input['to']) && !empty($input['to'])){
            $source = $source->where([
                ['date' , '>=' , date('Y-m-d H:i:s',strtotime($input['from'] . " 00:00:00"))],
                ['date' , '<=' , date('Y-m-d H:i:s',strtotime($input['to'] . " 23:59:59"))],
            ]);
        } 
        if(isset($input['category_id']) && !empty($input['category_id'])){
            $source = $source->where('category_id',$input['category_id']);
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
            $image = \FilesHelper::uploadFile('blogs',$request->file('image'),$return->id);
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
        $updateData = $validator->validated();
        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('blogs',$request->file('image'),$id);
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
            \FilesHelper::deleteDirectory(public_path('/').'/uploads/blogs/'.$id);
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
            $updateData['image'] = \FilesHelper::uploadFile('blogs',$request->file('image'),$id);
        }
        return $record->update($updateData);
    }
}
