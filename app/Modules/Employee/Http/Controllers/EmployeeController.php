<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentEmployeeRepository;
use App\Transformers\EmployeeResource;
use App\Entities\Role;
use App\Entities\Store;

class EmployeeController extends Controller {

    protected $employeeRepo;
    protected $errors;

    public function __construct(EloquentEmployeeRepository $employeeRepo) {
        $this->employeeRepo = $employeeRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Users = $this->employeeRepo->dataList($request);
            return Datatables::of(EmployeeResource::collection($Users))->make(true);
        }
        $Users = $this->employeeRepo->getAll($request);
        return view('Employee::index', compact('Users'));
    }

    public function create() {
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Employee::create',compact('stores'));
    }

    public function store(Request $request) {
        $request['role_id']= 4;
        $user = $this->employeeRepo->create($request);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->employeeRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Employee::edit', compact('model','stores'));
    }

    public function update(Request $request, $id) {
        $request['role_id']= 4;
        $user = $this->employeeRepo->update($request,$id);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $user = $this->employeeRepo->delete($id);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $user = $this->employeeRepo->restoreSoftDelte($id);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $user = $this->employeeRepo->quickEdit($request);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $user = $this->employeeRepo->deleteManyById($request);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $user = $this->employeeRepo->upload($request,$request->id);
        if(!$user){
            \Session::flash('error',$this->employeeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
}
