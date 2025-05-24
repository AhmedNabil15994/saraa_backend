<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','store_id','color','type','brand_id','model_id','year','prices','available_from','available_to','is_monthly','is_daily','image','attachments','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'cars';

    protected $appends = ['image_url','prices_arr','brand_name','model_name','store_name','title','description','seller_name','attachments_url'];

    public function getPricesArrAttribute(){
        return $this->prices != null ? \Helper::arrangePrices(json_decode($this->prices)) : [];
    }

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('cars',$this->id,$this->image,true);
    }

    public function getAttachmentsUrlAttribute(){
        $attachsArr =  $this->attachments != null ? unserialize($this->attachments) : [];
        if(empty($attachsArr)){
            return [];
        }
        $images = [];
        foreach ($attachsArr as $key => $value) {
            $images[] =  \FilesHelper::getImagePath('cars',$this->id,$value,true);
        }
        return $images;
    }

    public function CarType(){
        return $this->belongsTo('App\Entities\CarType','type','id');
    }

    public function Color(){
        return $this->belongsTo('App\Entities\Color','color','id');
    }

    public function Store(){
        return $this->belongsTo('App\Entities\Store','store_id','id');
    }

    public function Reservations(){
        return $this->hasMany('App\Entities\Reservation','car_id','id');
    }

    public function Brand(){
        return $this->belongsTo('App\Entities\Brand','brand_id','id');
    }

    public function CarModel(){
        return $this->belongsTo('App\Entities\CarModel','model_id','id');
    }

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function getDescriptionAttribute(){
        return $this->{'description_'.LANGUAGE_PREF};
    }

    public function getStoreNameAttribute(){
        return $this->Store->{'title_'.LANGUAGE_PREF};
    }

    public function getBrandNameAttribute(){
        return ($this->brand_id != null && $this->Brand) ? $this->Brand->{'title_'.LANGUAGE_PREF} : '';
    }

    public function getModelNameAttribute(){
        return $this->CarModel->{'title_'.LANGUAGE_PREF};
    }

    public function getSellerNameAttribute(){
        return $this->Store->Seller->name;
    }

    public function setAvailableFromAttribute($value){
        $this->attributes['available_from'] = date('Y-m-d H:i:s',strtotime($value));
    }

    public function setAvailableToAttribute($value){
        $this->attributes['available_to'] = date('Y-m-d H:i:s',strtotime($value));
    }

    public function hasReservation($from,$to,$notIn=0){
        return $this->Reservations != null ? $this->Reservations()->where('status','>',0)->where('id','!=',$notIn)->where(function($whereQuery) use($from,$to){
                $whereQuery->whereBetween('reserve_from',[$from,$to])->orWhereBetween('reserve_to',[$from,$to]);
        })->count()  : 0;
    }
}
