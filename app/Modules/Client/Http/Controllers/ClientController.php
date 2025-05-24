<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentClientRepository;
use App\Transformers\ClientResource;
use App\Entities\Role;
use App\Entities\Store;

class ClientController extends Controller {

    protected $clientRepo;
    protected $errors;

    public function __construct(EloquentClientRepository $clientRepo) {
        $this->clientRepo = $clientRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Users = $this->clientRepo->dataList($request);
            return Datatables::of(ClientResource::collection($Users))->make(true);
        }
        $Users = $this->clientRepo->getAll($request);
        return view('Client::index', compact('Users'));
    }

    public function create() {
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Client::create',compact('stores'));
    }

    public function store(Request $request) {
        $request['role_id']= 3;
        $user = $this->clientRepo->create($request);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->clientRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Client::edit', compact('model','stores'));
    }

    public function update(Request $request, $id) {
        $request['role_id']= 3;
        $user = $this->clientRepo->update($request,$id);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $user = $this->clientRepo->delete($id);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $user = $this->clientRepo->restoreSoftDelte($id);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $user = $this->clientRepo->quickEdit($request);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $user = $this->clientRepo->deleteManyById($request);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $user = $this->clientRepo->upload($request,$request->id);
        if(!$user){
            \Session::flash('error',$this->clientRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
}
