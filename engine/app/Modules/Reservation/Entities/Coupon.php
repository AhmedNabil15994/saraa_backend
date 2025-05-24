<?php

namespace App\Entities;

use App\Entities\Store;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['code','discount_type','discount_value','valid_type','valid_until','store_id','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $appends = ['discount_type_text','store_name'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'coupons';

    public function getDiscountTypeTextAttribute(){
        return trans('Coupon::coupon.form.type_'.$this->discount_type);
    }   

    public function getStoreNameAttribute(){
        return $this->Store ? $this->Store->{'title_'.LANGUAGE_PREF} : '';
    }
    
    public function Store(){
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    static function checkCouponByCode($code){
        return self::active()->where([
            ['code','=',$code],
            ['valid_type','=',1],
            ['valid_until','>',0],
        ])->orWhere([
            ['code','=',$code],
            ['valid_type','=',2],
            ['valid_until','>=',now()->format('Y-m-d')],
        ])->first();
    }


}
