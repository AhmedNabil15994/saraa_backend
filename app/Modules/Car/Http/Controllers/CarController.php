<?php

namespace App\Http\Controllers;

use App\Entities\Brand;
use App\Entities\CarModel;
use App\Entities\CarType;
use App\Entities\Color;
use App\Entities\Store;
use App\Entities\Year;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentCarRepository;
use App\Transformers\CarResource;
use DataTables;
use Illuminate\Http\Request;

class CarController extends Controller {

    protected $carRepo;
    protected $errors;

    public function __construct(EloquentCarRepository $carRepo) {
        $this->carRepo = $carRepo;
    }

    public function index(Request $request) {
        $data = [];
        if($request->ajax()){
            $Cars = $this->carRepo->dataList($request);
            return Datatables::of(CarResource::collection($Cars))->make(true);
        }
        $Cars = $this->carRepo->getAll($request);
        return view('Car::index', compact('Cars'));
    }

    public function create() {
        $brands = Brand::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $years = Year::active()->orderBy('title','desc')->get(['id',"title as display_name"]);
        $colors = Color::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $carTypes = CarType::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Car::create',compact('brands','stores','years','colors','carTypes'));
    }

    public function store(Request $request) {
        $car = $this->carRepo->create($request);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->carRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }
        $model = new CarResource($model);
        $brands = Brand::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $carModels = CarModel::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $years = Year::active()->orderBy('title','desc')->get(['id',"title as display_name"]);
        $colors = Color::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        $carTypes = CarType::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Car::edit', compact('model','carModels','brands','stores','years','colors','carTypes'));
    }

    public function update(Request $request, $id) {
        $car = $this->carRepo->update($request,$id);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $car = $this->carRepo->delete($id);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $car = $this->carRepo->restoreSoftDelte($id);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $car = $this->carRepo->quickEdit($request);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $car = $this->carRepo->deleteManyById($request);
        if(!$car){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $blog = $this->carRepo->upload($request,$request->id);
        if(!$blog){
            \Session::flash('error',$this->carRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

}
