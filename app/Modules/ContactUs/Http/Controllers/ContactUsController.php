<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentContactUsRepository;
use App\Transformers\ContactUsResource;

class ContactUsController extends Controller {

    protected $contactUsRepo;
    protected $errors;

    public function __construct(EloquentContactUsRepository $contactUsRepo ) {
        $this->contactUsRepo = $contactUsRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Contactuses = $this->contactUsRepo->dataList($request);
            return Datatables::of(ContactUsResource::collection($Contactuses))->make(true);
        }
        $Contactuses = $this->contactUsRepo->getAll($request);
        return view('ContactUs::index', compact('Contactuses'));
    }

    public function create() {
        return view('ContactUs::create');
    }

    public function store(Request $request) {
        $contactUs = $this->contactUsRepo->create($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->contactUsRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('ContactUs::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $contactUs = $this->contactUsRepo->update($request,$id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $contactUs = $this->contactUsRepo->delete($id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $contactUs = $this->contactUsRepo->restoreSoftDelte($id);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $contactUs = $this->contactUsRepo->quickEdit($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $contactUs = $this->contactUsRepo->deleteManyById($request);
        if(!$contactUs){
            \Session::flash('error',$this->contactUsRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
