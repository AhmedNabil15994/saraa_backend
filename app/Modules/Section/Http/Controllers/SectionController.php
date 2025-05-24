<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentSectionRepository;
use App\Transformers\SectionResource;
use App\Entities\Page;

class SectionController extends Controller {

    protected $sectionRepo;
    protected $errors;

    public function __construct(EloquentSectionRepository $sectionRepo ) {
        $this->sectionRepo = $sectionRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Sections = $this->sectionRepo->dataList($request);
            return Datatables::of(SectionResource::collection($Sections))->make(true);
        }
        $Sections = $this->sectionRepo->getAll($request);
        return view('Section::index', compact('Sections'));
    }

    public function create() {
        $pages = Page::active()->get(['id',"name_".LANGUAGE_PREF." as display_name"]);
        return view('Section::create',compact('pages'));
    }

    public function store(Request $request) {
        $section = $this->sectionRepo->create($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->sectionRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }
        $pages = Page::active()->get(['id',"name_".LANGUAGE_PREF." as display_name"]);
        return view('Section::edit', compact('model','pages'));
    }

    public function update(Request $request, $id) {
        $section = $this->sectionRepo->update($request,$id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $section = $this->sectionRepo->delete($id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $section = $this->sectionRepo->restoreSoftDelte($id);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $section = $this->sectionRepo->quickEdit($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $section = $this->sectionRepo->deleteManyById($request);
        if(!$section){
            \Session::flash('error',$this->sectionRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
