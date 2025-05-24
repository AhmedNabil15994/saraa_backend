<?php namespace App\Http\Controllers;

use App\Entities\Car;
use App\Entities\Coupon;
use App\Entities\Reservation;
use App\Http\Requests\CouponRequest;
use App\Http\Requests\ReservationRequest;
use App\Repositories\ReservationRepository;
use App\Services\Payment\KnetPaymentService;
use App\Transformers\ReservationResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ReservationControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    protected $payment;

    public function __construct(ReservationRepository $repo, KnetPaymentService $payment) {
        $this->repo = $repo;
        $this->payment = $payment;
    }

    public function index(Request $request){
        $dataList = $this->repo->filterReservations($request);
        return \TraitsFunc::responsePagnation(ReservationResource::collection($dataList));
    }

    public function show($id){
        $reservationObj = $this->repo->getOneForUser($id);
        if($reservationObj instanceof JsonResponse){
            return $reservationObj;
        }
        
        $dataList = new ReservationResource($reservationObj);
        return \TraitsFunc::response($dataList);
    }

    public function create(ReservationRequest $request){
        $reservationObj = $this->repo->createReservation($request);
        if($reservationObj instanceof JsonResponse){
            return $reservationObj;
        }
     
        $url = $this->payment->send([
            'id' => $reservationObj->id,
            'total' => $reservationObj->discount_price > 0 ? $reservationObj->discount_price : $reservationObj->price,
            'name' => $reservationObj->Client->name,
            'mobile' => $reservationObj->Client->mobile,
            'email' => $reservationObj->Client->email,
        ]);
        $reservationObj->payment_url = $url;
        $dataList = new ReservationResource($reservationObj);
        return \TraitsFunc::response($dataList);
    }

    public function cancel($id){
        $reservationObj = $this->repo->getOneForUser($id);
        if($reservationObj instanceof JsonResponse){
            return $reservationObj;
        }

        $reservationObj->update(['status' => 0]);
        $reservationObj->payments()->first()->update(['status' => 'failed']);

        return \TraitsFunc::response([
            'cancelled' => true,
        ],trans('main.cancelled'));        
    }

    public function checkCoupon(CouponRequest $request){
        $check = $this->repo->checkCoupon($request);
        if($check instanceof JsonResponse){
            return $check;
        }
        return \TraitsFunc::response($check);
    }
}
