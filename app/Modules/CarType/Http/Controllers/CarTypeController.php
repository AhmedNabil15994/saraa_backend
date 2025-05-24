<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentCarTypeRepository;
use App\Transformers\CarTypeResource;

class CarTypeController extends Controller {

    protected $carTypeRepo;
    protected $errors;

    public function __construct(EloquentCarTypeRepository $carTypeRepo) {
        $this->carTypeRepo = $carTypeRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $CarTypes = $this->carTypeRepo->dataList($request);
            return Datatables::of(CarTypeResource::collection($CarTypes))->make(true);
        }
        $CarTypes = $this->carTypeRepo->getAll($request);
        return view('CarType::index', compact('CarTypes'));
    }

    public function create() {
        return view('CarType::create');
    }

    public function store(Request $request) {
        $carType = $this->carTypeRepo->create($request);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors->first());
            return redirect()->back()->withInput();
        }
        if($request->ajax()){
            return $carType;
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->carTypeRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->carTypeRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('CarType::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $carType = $this->carTypeRepo->update($request,$id);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $carType = $this->carTypeRepo->delete($id);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $carType = $this->carTypeRepo->restoreSoftDelte($id);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $carType = $this->carTypeRepo->quickEdit($request);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $carType = $this->carTypeRepo->deleteManyById($request);
        if(!$carType){
            \Session::flash('error',$this->carTypeRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
