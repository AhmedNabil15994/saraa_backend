<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Entities\Payment;

class Reservation extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = [
        'store_id',
        'car_id',
        'client_id',
        'reserve_from',
        'reserve_to',
        'price',
        'files',
        'lat',
        'lng',
        'notes',
        'coupon_id',
        'discount_price',
        'status',
        'state_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'address'
];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $appends = ['store_name','client_name','car_name','seller_name','files_url'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'reservations';

    protected $casts = [
        'address' => 'array',
    ];


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getFilesUrlAttribute(){
        $attachsArr =  $this->files != null ? unserialize($this->files) : [];
        if(empty($attachsArr)){
            return [];
        }
        $images = [];
        foreach ($attachsArr as $key => $value) {
            $images[] =  \FilesHelper::getImagePath('reservations',$this->id,$value,true);
        }
        return $images;
    }

    public function Store(){
        return $this->belongsTo('App\Entities\Store','store_id','id');
    }

    public function Car(){
        return $this->belongsTo('App\Entities\Car','car_id','id');
    }

    public function Client(){
        return $this->belongsTo('App\Entities\User','client_id','id');
    }

    public function Coupon(){
        return $this->belongsTo('App\Entities\Coupon','coupon_id','id');
    }

    public function getStoreNameAttribute(){
        return $this->Store ? $this->Store->{'title_'.LANGUAGE_PREF} : '';
    }

    public function getCarNameAttribute(){
        return $this->Car ? $this->Car->{'title_'.LANGUAGE_PREF} : '';
    }

    public function getClientNameAttribute(){
        return $this->Client ? $this->Client->name : '';
    }

    public function getSellerNameAttribute(){
        return $this->Store ? $this->Store->Seller->name : '';
    }

    public function payment(){
        return $this->morphOne(Payment::class, "order")->where("status", "wait");
    }

    public function payments(){
        return $this->morphMany(Payment::class, "order");
    }

    public function ActivePayment(){
        return $this->morphOne(Payment::class, "order")->where("status", "paid");
    }
}
