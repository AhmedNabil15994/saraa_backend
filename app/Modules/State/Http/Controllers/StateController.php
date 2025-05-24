<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentStateRepository;
use App\Transformers\StateResource;
use App\Entities\Country;

class StateController extends Controller {

    protected $stateRepo;
    protected $errors;

    public function __construct(EloquentStateRepository $stateRepo) {
        $this->stateRepo = $stateRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $States = $this->stateRepo->dataList($request);
            return Datatables::of(StateResource::collection($States))->make(true);
        }
        $States = $this->stateRepo->getAll($request);
        return view('State::index', compact('States'));
    }

    public function create() {
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('State::create',compact('countries'));
    }

    public function store(Request $request) {
        $state = $this->stateRepo->create($request);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->stateRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->stateRepo->errors);
            return redirect()->back()->withInput();
        }
        $countries = Country::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('State::edit', compact('model','countries'));
    }

    public function update(Request $request, $id) {
        $state = $this->stateRepo->update($request,$id);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $state = $this->stateRepo->delete($id);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $state = $this->stateRepo->restoreSoftDelte($id);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $state = $this->stateRepo->quickEdit($request);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $state = $this->stateRepo->deleteManyById($request);
        if(!$state){
            \Session::flash('error',$this->stateRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
