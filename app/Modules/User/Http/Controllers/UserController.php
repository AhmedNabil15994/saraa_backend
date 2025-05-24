<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentUserRepository;
use App\Transformers\UserResource;
use App\Entities\Role;

class UserController extends Controller {

    protected $userRepo;
    protected $errors;

    public function __construct(EloquentUserRepository $userRepo) {
        $this->userRepo = $userRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Users = $this->userRepo->dataList($request);
            return Datatables::of(UserResource::collection($Users))->make(true);
        }
        $Users = $this->userRepo->getAll($request);
        return view('User::index', compact('Users'));
    }

    public function create() {
        $roles = Role::get(['id',"name_".LANGUAGE_PREF." as display_name"]);
        return view('User::create',compact('roles'));
    }

    public function store(Request $request) {
        $user = $this->userRepo->create($request);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->userRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }
        $roles = Role::get(['id',"name_".LANGUAGE_PREF." as display_name"]);
        return view('User::edit', compact('model','roles'));
    }

    public function update(Request $request, $id) {
        $user = $this->userRepo->update($request,$id);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $user = $this->userRepo->delete($id);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $user = $this->userRepo->restoreSoftDelte($id);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $user = $this->userRepo->quickEdit($request);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $user = $this->userRepo->deleteManyById($request);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $user = $this->userRepo->upload($request,$request->id);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
}
