<?php

namespace App\Http\Controllers;

use App\Entities\Store;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentCouponRepository;
use App\Transformers\CouponResource;
use DataTables;
use Illuminate\Http\Request;

class CouponController extends Controller {

    protected $couponRepo;
    protected $errors;

    public function __construct(EloquentCouponRepository $couponRepo) {
        $this->couponRepo = $couponRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Coupons = $this->couponRepo->dataList($request);
            return Datatables::of(CouponResource::collection($Coupons))->make(true);
        }
        $Coupons = $this->couponRepo->getAll($request);
        return view('Coupon::index', compact('Coupons'));
    }

    public function create() {
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Coupon::create',compact('stores'));
    }

    public function store(Request $request) {
        $coupon = $this->couponRepo->create($request);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors->first());
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.addSuccess'));
        return redirect()->back();
    }

    public function edit($id) {
        $model = $this->couponRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->couponRepo->errors);
            return redirect()->back()->withInput();
        }
        $stores = Store::active()->get(['id',"title_".LANGUAGE_PREF." as display_name"]);
        return view('Coupon::edit', compact('model','stores'));
    }

    public function update(Request $request, $id) {
        $coupon = $this->couponRepo->update($request,$id);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $coupon = $this->couponRepo->delete($id);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $coupon = $this->couponRepo->restoreSoftDelte($id);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }

    public function fastEdit(Request $request) {
        $coupon = $this->couponRepo->quickEdit($request);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.editSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function deleteSelected(Request $request) {
        $coupon = $this->couponRepo->deleteManyById($request);
        if(!$coupon){
            \Session::flash('error',$this->couponRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
