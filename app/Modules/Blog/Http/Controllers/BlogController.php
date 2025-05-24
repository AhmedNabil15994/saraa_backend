<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentBlogRepository;
use App\Transformers\BlogResource;
use App\Entities\Category;

class BlogController extends Controller {

    protected $blogRepo;
    protected $errors;

    public function __construct(EloquentBlogRepository $blogRepo) {
        $this->blogRepo = $blogRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Blogs = $this->blogRepo->dataList($request);
            return Datatables::of(BlogResource::collection($Blogs))->make(true);
        }
        $Blogs = $this->blogRepo->getAll($request);
        return view('Blog::index', compact('Blogs'));
    }

    public function create() {
        return view('Blog::create');
    }

    public function store(Request $request) {
        $blog = $this->blogRepo->create($request);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->blogRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->blogRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Blog::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $blog = $this->blogRepo->update($request,$id);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $blog = $this->blogRepo->delete($id);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $blog = $this->blogRepo->restoreSoftDelte($id);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $blog = $this->blogRepo->quickEdit($request);
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

    public function deleteSelected(Request $request) {
        $blog = $this->blogRepo->deleteManyById($request);
        if(!$blog){
            \Session::flash('error',$this->blogRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $blog = $this->blogRepo->upload($request,$request->id);
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
