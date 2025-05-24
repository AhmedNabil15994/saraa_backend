<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentYearRepository;
use App\Transformers\YearResource;

class YearController extends Controller {

    protected $yearRepo;
    protected $errors;

    public function __construct(EloquentYearRepository $yearRepo) {
        $this->yearRepo = $yearRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Years = $this->yearRepo->dataList($request);
            return Datatables::of(YearResource::collection($Years))->make(true);
        }
        $Years = $this->yearRepo->getAll($request);
        return view('Year::index', compact('Years'));
    }

    public function create() {
        return view('Year::create');
    }

    public function store(Request $request) {
        $year = $this->yearRepo->create($request);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->yearRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->yearRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Year::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $year = $this->yearRepo->update($request,$id);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $year = $this->yearRepo->delete($id);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $year = $this->yearRepo->restoreSoftDelte($id);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $year = $this->yearRepo->quickEdit($request);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $year = $this->yearRepo->deleteManyById($request);
        if(!$year){
            \Session::flash('error',$this->yearRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
