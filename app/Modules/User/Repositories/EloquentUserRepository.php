<?php

namespace App\Repositories;

use App\Interfaces\EntityRepositoryInterface;
use App\Entities\User as Model;
use App\Http\Requests\UserValidator as ModelValidator;
use App\Http\Requests\UserUpdateValidator as ModelUpdateValidator;

class EloquentUserRepository implements EntityRepositoryInterface {

    protected $model;
    public $errors;
    // protected $createValidator;
    // protected $updateValidator;

    public function __construct(Model $model) {
        $this->model = $model;
        // $this->createValidator = $createValidator;
        // $this->updateValidator = $updateValidator;
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
        if(isset($input['name']) && !empty($input['name'])){
            $source = $source->where('name','LIKE','%'.$input['name'].'%');
        }
        if(isset($input['mobile']) && !empty($input['mobile'])){
            $source = $source->where('mobile',$input['mobile']);
        }
        if(isset($input['role_id']) && !empty($input['role_id'])){
            $source = $source->where('role_id',$input['role_id']);
        }
        if(isset($input['email']) && !empty($input['email'])){
            $source = $source->where('email','LIKE','%'.$input['email'].'%');
        }
        if(isset($input['status']) && !empty($input['status'])){
            $source = $source;
        }else{
            $source = $source->where('status',1);
        }

        return $source->orderBy('id','DESC')->get();
    }

    public function getAll($request) {
        return $this->model->all();
    }

    public function create($request) {
        $createData = $request->validated();
        if(isset($createData['extra_permissions']) && count($createData['extra_permissions']) > 0){
            $createData['extra_permissions'] = serialize($createData['extra_permissions']);
        }
        $return = $this->model->create($createData);
        if($request->hasFile('image')){
            $image = \FilesHelper::uploadFile('users',$request->file('image'),$return->id);
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

        $updateData = $request->validated();
        if($request->hasFile('image')){
            $updateData['image'] = \FilesHelper::uploadFile('users',$request->file('image'),$id);
        }

        if(isset($updateData['extra_permissions'])){
            $updateData['extra_permissions'] = serialize($updateData['extra_permissions']);
        }else{
            $updateData['extra_permissions'] = null;
        }
        if(!isset($updateData['password']) || $updateData['password'] == null){
            unset($updateData['password']);
        }
        if(!isset($updateData['status'])){
            $updateData['status'] = 0;
        }
        if(!isset($updateData['is_verified'])){
            $updateData['is_verified'] = 0;
        }
        return $record->update($updateData);
    }

    public function delete($id) {
        $record = $this->getById($id);
        if(!$record){
            return false;
        }

        if ($record->trashed()){
            \FilesHelper::deleteDirectory(public_path('/').'/uploads/users/'.$id);
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
            $updateData['image'] = \FilesHelper::uploadFile('users',$request->file('image'),$id);
        }
        return $record->update($updateData);
    }
}
