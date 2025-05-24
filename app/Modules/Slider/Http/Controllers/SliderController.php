<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentSliderRepository;
use App\Transformers\SliderResource;

class SliderController extends Controller {

    protected $sliderRepo;
    protected $errors;

    public function __construct(EloquentSliderRepository $sliderRepo  ) {
        $this->sliderRepo = $sliderRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $sliders = $this->sliderRepo->dataList($request);
            return Datatables::of(SliderResource::collection($sliders))->make(true);
        }
        $sliders = $this->sliderRepo->getAll($request);
        return view('Slider::index', compact('sliders'));
    }

    public function create() {
        return view('Slider::create' );
    }

    public function store(Request $request) {
        $slider = $this->sliderRepo->create($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->sliderRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Slider::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $slider = $this->sliderRepo->update($request,$id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $slider = $this->sliderRepo->delete($id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $slider = $this->sliderRepo->restoreSoftDelte($id);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $slider = $this->sliderRepo->quickEdit($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $slider = $this->sliderRepo->deleteManyById($request);
        if(!$slider){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $blog = $this->sliderRepo->upload($request,$request->id);
        if(!$blog){
            \Session::flash('error',$this->sliderRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
    
}
