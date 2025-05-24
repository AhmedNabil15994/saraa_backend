<?php

namespace App\Entities;

use App\Entities\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['store_id','car_id','client_id','reserve_from','reserve_to','price','files','coupon_id','discount_price','lat','lng','status','created_at','updated_at','deleted_at','address','state_id'];

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


    const STREET = 'street';
    const BLOCK = 'block';
    const BUILDING = 'building';

    static function getAddressConstants() {
        return [
            self::STREET,
            self::BLOCK,
            self::BUILDING,
        ];
    }

    protected $casts = [
        'address' => 'array',
    ];


    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function setReserveFromAttribute($value){
        return $this->attributes['reserve_from'] = date('Y-m-d H:i:s',strtotime($value));
    }

    public function setReserveToAttribute($value){
        return $this->attributes['reserve_to'] = date('Y-m-d 12:i:s',strtotime($value));
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

    public function payment(){
        return $this->morphOne(Payment::class, "order")->where("status", "wait");
    }

    public function payments(){
        return $this->morphMany(Payment::class, "order");
    }
}
