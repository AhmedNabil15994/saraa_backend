<?php

namespace App\Repositories;

use App\Entities\Car;
use App\Entities\Coupon;
use App\Entities\Reservation;
use App\Entities\User;
use App\Transformers\ReservationResource;

class ReservationRepository {

    protected $model;
    public function __construct(Reservation $model){
        $this->model = $model;
    }

    public function getOneForUser($id){
        $id = (int) $id;
        $reservationObj = $this->model->find($id);
        if(!$reservationObj || $reservationObj->client_id != USER_ID){
            return \TraitsFunc::error(trans('main.notFound'));
        }
        return $reservationObj;
    }

    public function createReservation($request){
        $input = $request->validated();
        $couponDiscount = null;
        $checkCar = Car::find($input['car_id']);

        $checkReservationDates = $checkCar != null ? $checkCar->hasReservation($input['reserve_from'],$input['reserve_to']) : true;
        if($checkReservationDates){
            return \TraitsFunc::error(trans('main.carReservedInThisRange'));
        }

        $days = round((strtotime($input['reserve_to']) - strtotime($input['reserve_from'])) / (60 * 60) / 24);
        $input['price'] = \Helper::calcCarReservationDaysPrice($days,$checkCar->prices_arr);

        if(isset($request['coupon_code']) && !empty($request['coupon_code'])){
            $couponObj = Coupon::checkCouponByCode($request['coupon_code']);
            if(!$couponObj || $couponObj->store_id != $checkCar->store_id){
                return \TraitsFunc::error(trans('main.invalid_coupon'));
            }
            $couponDiscount = $couponObj->discount_type == 2 ?  round( ($input['price'] * ( $couponObj->discount_value /100) ) ,2) : $couponObj->discount_value;
        }

        $storeObj = $checkCar->Store;

        foreach(Reservation::getAddressConstants() as $constant){

            $input['address'][$constant] = $request[$constant];
        }

        $input['client_id'] = USER_ID;
        $input['status'] = 2;
        $input['store_id'] = $storeObj->id;

        if(!isset($input['lat']) || empty($input['lat'])){
            $input['lat'] = $storeObj->lat;
        }
        if(!isset($input['lng']) || empty($input['lng'])){
            $input['lng'] = $storeObj->lng;
        }

        $reservationObj = $this->model->create($input);

        if($couponDiscount){
            $reservationObj->update([
                'coupon_id' => $couponObj->id,
                'discount_price' => $reservationObj->price - $couponDiscount,
            ]);
        }

        if($request->hasFile('files')){
            $imagesArr = [];
            foreach ($request->file('files') as $key => $value) {
                $imagesArr[] = \FilesHelper::uploadFile('reservations',$value,$reservationObj->id);
            }
            $reservationObj->update(['files'=>serialize($imagesArr)]);
        }

        $this->paymentHandler($reservationObj);

        return $reservationObj;
    }

    public function filterReservations($request){
        $input = \Request::all();
        $source =  $this->model->where('client_id',USER_ID)->where('status','>',0);
        if(isset($input['delievered']) && $input['delievered'] == 1){
            $source->where('reserve_to', '<=' , date('Y-m-d H:i:s'));
        }

        $sourceArr = $source->orderBy('id','DESC')->paginate($request->per_page??10);
        return $sourceArr;
    }

    public function checkCoupon($request){
        $couponDiscount = null;
        $checkCar = Car::find($request['car_id']);

        $checkReservationDates = $checkCar->hasReservation($request['reserve_from'],$request['reserve_to']);
        if($checkReservationDates){
            return \TraitsFunc::error(trans('main.carReservedInThisRange'));
        }

        $days = round((strtotime($request['reserve_to']) - strtotime($request['reserve_from'])) / (60 * 60) / 24);
        $price = \Helper::calcCarReservationDaysPrice($days,$checkCar->prices_arr);

        if(isset($request['coupon_code']) && !empty($request['coupon_code'])){
            $couponDiscount = null;
            $couponObj = Coupon::checkCouponByCode($request['coupon_code']);
            if(!$couponObj || $couponObj->store_id != $checkCar->store_id){
                return \TraitsFunc::error(trans('main.invalid_coupon'));
            }
            $couponDiscount = $couponObj->discount_type == 2 ?  round( ($price * ( $couponObj->discount_value /100) ) ,2) : $couponObj->discount_value;
        }

        return [
            'price' => (string)$price,
            'price_after_discount' =>  (string) ($couponDiscount ?  $price - $couponDiscount : $price),
            'discount' => (string) $couponDiscount,
            'days' => $days,
        ];
    }

    public function paymentHandler(&$reservationObj)
    {
        $payment = $reservationObj->payments()->updateOrCreate([
            "status" => "wait"
        ], [
            "owner"=> User::find(USER_ID) ,
            "total" => $reservationObj->discount_price ?? $reservationObj->price,
            "user_id"=> USER_ID,
        ]);

        return $payment;
    }

}
