<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentStoreRepository;
use App\Transformers\StoreResource;
use App\Entities\User;
use App\Entities\Country;
use App\Entities\City;
use App\Entities\State;


class StoreController extends Controller {

    protected $storeRepo;
    protected $errors;

    public function __construct(EloquentStoreRepository $storeRepo) {
        $this->storeRepo = $storeRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Stores = $this->storeRepo->dataList($request);
            return Datatables::of(StoreResource::collection($Stores))->make(true);
        }
        $Stores = $this->storeRepo->getAll($request);
        return view('Store::index', compact('Stores'));
    }

    public function create() {
        $sellers = User::active()->where('role_id',2)->get(['id','name']);
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $employees = User::active()->where('role_id',4)->get(['id','name']);
        return view('Store::create',compact('sellers','countries','employees'));
    }

    public function store(Request $request) {
        $store = $this->storeRepo->create($request);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->storeRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->storeRepo->errors);
            return redirect()->back()->withInput();
        }
        $sellers = User::active()->where('role_id',2)->get(['id','name']);
        $employees = User::active()->where('role_id',4)->get(['id','name']);
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $cities = City::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $states = State::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Store::edit', compact('model','sellers','countries','cities','states','employees'));
    }

    public function update(Request $request, $id) {
        $store = $this->storeRepo->update($request,$id);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $store = $this->storeRepo->delete($id);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $store = $this->storeRepo->restoreSoftDelte($id);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $store = $this->storeRepo->quickEdit($request);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $store = $this->storeRepo->deleteManyById($request);
        if(!$store){
            \Session::flash('error',$this->storeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $blog = $this->blogRepo->upload($request,$request->id);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
    
}
