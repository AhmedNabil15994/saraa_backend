<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentSellerRepository;
use App\Transformers\SellerResource;
use App\Entities\Role;

class SellerController extends Controller {

    protected $sellerRepo;
    protected $errors;

    public function __construct(EloquentSellerRepository $sellerRepo) {
        $this->sellerRepo = $sellerRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Users = $this->sellerRepo->dataList($request);
            return Datatables::of(SellerResource::collection($Users))->make(true);
        }
        $Users = $this->sellerRepo->getAll($request);
        return view('Seller::index', compact('Users'));
    }

    public function create() {
        return view('Seller::create');
    }

    public function store(Request $request) {
        $request['role_id']= 2;
        $user = $this->sellerRepo->create($request);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->sellerRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Seller::edit', compact('model'));
    }

    public function update(Request $request, $id) {
        $request['role_id']= 2;
        $user = $this->sellerRepo->update($request,$id);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $user = $this->sellerRepo->delete($id);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $user = $this->sellerRepo->restoreSoftDelte($id);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $user = $this->sellerRepo->quickEdit($request);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $user = $this->sellerRepo->deleteManyById($request);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function uploadImg(Request $request){
        $user = $this->sellerRepo->upload($request,$request->id);
        if(!$user){
            \Session::flash('error',$this->sellerRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();    
    }
}
