<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentBrandRepository;
use App\Transformers\BrandResource;

class BrandController extends Controller {

    protected $brandRepo;
    protected $errors;

    public function __construct(EloquentBrandRepository $brandRepo) {
        $this->brandRepo = $brandRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Brands = $this->brandRepo->dataList($request);
            return Datatables::of(BrandResource::collection($Brands))->make(true);
        }
        $Brands = $this->brandRepo->getAll($request);
        return view('Brand::index', compact('Brands'));
    }

    public function create() {
        return view('Brand::create');
    }

    public function store(Request $request) {
        $brand = $this->brandRepo->create($request);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->brandRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->brandRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Brand::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $brand = $this->brandRepo->update($request,$id);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $brand = $this->brandRepo->delete($id);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $brand = $this->brandRepo->restoreSoftDelte($id);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $brand = $this->brandRepo->quickEdit($request);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $brand = $this->brandRepo->deleteManyById($request);
        if(!$brand){
            \Session::flash('error',$this->brandRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $blog = $this->brandRepo->upload($request,$request->id);
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
