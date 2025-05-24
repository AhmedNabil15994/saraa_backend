<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCarModelRepository;
use App\Transformers\CarModelResource;
use App\Entities\Brand;

class CarModelController extends Controller {

    protected $carModelRepo;
    protected $errors;

    public function __construct(EloquentCarModelRepository $carModelRepo) {
        $this->carModelRepo = $carModelRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $CarModels = $this->carModelRepo->dataList($request);
            return Datatables::of(CarModelResource::collection($CarModels))->make(true);
        }
        $CarModels = $this->carModelRepo->getAll($request);
        return view('CarModel::index', compact('CarModels'));
    }

    public function create() {
        $brands = Brand::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('CarModel::create',compact('brands'));
    }

    public function store(Request $request) {
        $carModel = $this->carModelRepo->create($request);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->carModelRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->carModelRepo->errors);
            return redirect()->back()->withInput();
        }
        $brands = Brand::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('CarModel::edit', compact('model','brands'));
    }

    public function update(Request $request, $id) {
        $carModel = $this->carModelRepo->update($request,$id);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $carModel = $this->carModelRepo->delete($id);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $carModel = $this->carModelRepo->restoreSoftDelte($id);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $carModel = $this->carModelRepo->quickEdit($request);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $carModel = $this->carModelRepo->deleteManyById($request);
        if(!$carModel){
            \Session::flash('error',$this->carModelRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
