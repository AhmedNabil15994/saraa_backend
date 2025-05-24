<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Repositories\EloquentReservationRepository;
use App\Transformers\ReservationResource;

class ReservationController extends Controller {

    protected $reservationRepo;
    protected $errors;

    public function __construct(EloquentReservationRepository $reservationRepo) {
        $this->reservationRepo = $reservationRepo;
    }

    public function index(Request $request) {
        if($request->ajax()){
            $Reservations = $this->reservationRepo->dataList($request);
            return Datatables::of(ReservationResource::collection($Reservations))->make(true);
        }
        $Reservations = $this->reservationRepo->getAll($request);
        $data['dis'] = true;
        $disableEdit = true;
        $hasView = true;
        $data = (object) $data;
        return view('Reservation::index', compact('Reservations','data','disableEdit','hasView'));
    }

    public function paid(Request $request) {
        if($request->ajax()){
            $Reservations = $this->reservationRepo->dataList($request);
            return Datatables::of(ReservationResource::collection($Reservations))->make(true);
        }
        $Reservations = $this->reservationRepo->getAll($request);
        $data['dis'] = true;
        $disableEdit = true;
        $hasView = true;
        $data = (object) $data;
        return view('Reservation::paid', compact('Reservations','data','disableEdit','hasView'));
    }

    public function pending(Request $request) {
        if($request->ajax()){
            $Reservations = $this->reservationRepo->dataList($request);
            return Datatables::of(ReservationResource::collection($Reservations))->make(true);
        }
        $Reservations = $this->reservationRepo->getAll($request);
        $data['dis'] = true;
        $hasView = true;
        $disableEdit = true;
        $data = (object) $data;
        return view('Reservation::pending', compact('Reservations','data','disableEdit','hasView'));
    }

    public function unCompleted(Request $request) {
        if($request->ajax()){
            $Reservations = $this->reservationRepo->dataList($request);
            return Datatables::of(ReservationResource::collection($Reservations))->make(true);
        }
        $Reservations = $this->reservationRepo->getAll($request);
        $data['dis'] = true;
        $disableEdit = true;
        $hasView = true;
        $data = (object) $data;
        return view('Reservation::un-completed', compact('Reservations','data','disableEdit','hasView'));
    }

    public function view($id) {
        $model = $this->reservationRepo->getById($id);
        if(!$model){
            \Session::flash('error',$this->reservationRepo->errors);
            return redirect()->back()->withInput();
        }
        return view('Reservation::view', compact('model'));
    }

    public function update(Request $request, $id) {
        $model = $this->reservationRepo->update($request,$id);
        if(!$model){
            \Session::flash('error',$this->reservationRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

    public function delete(Request $request,$id) {
        $reservation = $this->reservationRepo->delete($id);
        if(!$reservation){
            \Session::flash('error',$this->reservationRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }

    public function restore($id) {
        $reservation = $this->reservationRepo->restoreSoftDelte($id);
        if(!$reservation){
            \Session::flash('error',$this->reservationRepo->errors);
            return redirect()->back()->withInput();
        }
        \Session::flash('success',trans('Dashboard::dashboard.restoreSuccess'));
        return redirect()->back();
    }
    
    public function deleteSelected(Request $request) {
        $reservation = $this->reservationRepo->deleteManyById($request);
        if(!$reservation){
            \Session::flash('error',$this->reservationRepo->errors);
            return redirect()->back()->withInput();
        }

        if($request->ajax()){
            return \TraitsFunc::SuccessMessage(trans('Dashboard::dashboard.deleteSuccess'));
        }

        \Session::flash('success',trans('Dashboard::dashboard.deleteSuccess'));
        return redirect()->back();
    }
    
}
