<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentEmployeeRoleRepository;
use App\Transformers\EmployeeRoleResource;
use App\Entities\User;


class EmployeeRoleController extends Controller {

    protected $roleRepo;
    protected $errors;

    public function __construct(EloquentEmployeeRoleRepository $roleRepo ) {
        $this->roleRepo = $roleRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Roles = $this->roleRepo->dataList($request);
            return Datatables::of(EmployeeRoleResource::collection($Roles))->make(true);
        }
        $Roles = $this->roleRepo->getAll($request);
        return view('EmployeeRole::index', compact('Roles'));
    }

    public function create() {
        $sellers = User::active()->where('role_id',2)->get(['id','name']);
        return view('EmployeeRole::create',compact('sellers'));
    }

    public function store(Request $request) {
        $role = $this->roleRepo->create($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->roleRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('EmployeeRole::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $role = $this->roleRepo->update($request,$id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $role = $this->roleRepo->delete($id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $role = $this->roleRepo->restoreSoftDelte($id);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $role = $this->roleRepo->quickEdit($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $role = $this->roleRepo->deleteManyById($request);
        if(!$role){
            \Session::flash('error',$this->roleRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
