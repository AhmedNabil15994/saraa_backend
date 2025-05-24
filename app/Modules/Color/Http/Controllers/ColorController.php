<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentColorRepository;
use App\Transformers\ColorResource;

class ColorController extends Controller {

    protected $colorRepo;
    protected $errors;

    public function __construct(EloquentColorRepository $colorRepo) {
        $this->colorRepo = $colorRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Colors = $this->colorRepo->dataList($request);
            return Datatables::of(ColorResource::collection($Colors))->make(true);
        }
        $Colors = $this->colorRepo->getAll($request);
        return view('Color::index', compact('Colors'));
    }

    public function create() {
        return view('Color::create');
    }

    public function store(Request $request) {
        $color = $this->colorRepo->create($request);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors->first());
            return redirect()->back()->withInput();
        }
        if($request->ajax()){
            return $color;
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->colorRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->colorRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Color::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $color = $this->colorRepo->update($request,$id);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $color = $this->colorRepo->delete($id);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $color = $this->colorRepo->restoreSoftDelte($id);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $color = $this->colorRepo->quickEdit($request);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $color = $this->colorRepo->deleteManyById($request);
        if(!$color){
            \Session::flash('error',$this->colorRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
