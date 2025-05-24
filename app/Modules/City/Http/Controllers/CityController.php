<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCityRepository;
use App\Transformers\CityResource;
use App\Entities\Country;

class CityController extends Controller {

    protected $cityRepo;
    protected $errors;

    public function __construct(EloquentCityRepository $cityRepo) {
        $this->cityRepo = $cityRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Cities = $this->cityRepo->dataList($request);
            return Datatables::of(CityResource::collection($Cities))->make(true);
        }
        $Cities = $this->cityRepo->getAll($request);
        return view('City::index', compact('Cities'));
    }

    public function create() {
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('City::create',compact('countries'));
    }

    public function store(Request $request) {
        $city = $this->cityRepo->create($request);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->cityRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->cityRepo->errors);
            return redirect()->back()->withInput();
        }
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('City::edit', compact('model','countries'));
    }

    public function update(Request $request, $id) {
        $city = $this->cityRepo->update($request,$id);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $city = $this->cityRepo->delete($id);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $city = $this->cityRepo->restoreSoftDelte($id);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $city = $this->cityRepo->quickEdit($request);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $city = $this->cityRepo->deleteManyById($request);
        if(!$city){
            \Session::flash('error',$this->cityRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
