<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCountryRepository;
use App\Transformers\CountryResource;

class CountryController extends Controller {

    protected $countryRepo;
    protected $errors;

    public function __construct(EloquentCountryRepository $countryRepo) {
        $this->countryRepo = $countryRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Countries = $this->countryRepo->dataList($request);
            return Datatables::of(CountryResource::collection($Countries))->make(true);
        }
        $Countries = $this->countryRepo->getAll($request);
        return view('Country::index', compact('Countries'));
    }

    public function create() {
        return view('Country::create');
    }

    public function store(Request $request) {
        $country = $this->countryRepo->create($request);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->countryRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->countryRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Country::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $country = $this->countryRepo->update($request,$id);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $country = $this->countryRepo->delete($id);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $country = $this->countryRepo->restoreSoftDelte($id);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $country = $this->countryRepo->quickEdit($request);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $country = $this->countryRepo->deleteManyById($request);
        if(!$country){
            \Session::flash('error',$this->countryRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
