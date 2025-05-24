<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','seller_id','image','state_id','address_ar','address_en','lat','lng','off_days','work_from','work_to','contact_info','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'stores';

    protected $appends = ['image_url','seller_name','work_from_arr','work_to_arr','state_name','country_name','address','city_name','title','description','off_days_arr'];

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('stores',$this->id,$this->image,true);
    }

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function getDescriptionAttribute(){
        return $this->{'description_'.LANGUAGE_PREF};
    }

    public function getWorkFromArrAttribute(){
        return $this->work_from != null ? (array)json_decode($this->work_from) : [];
    }

    public function getWorkToArrAttribute(){
        return $this->work_to != null ? (array)json_decode($this->work_to) : [];
    }

    public function getAddressAttribute(){
        return $this->{'address_'.LANGUAGE_PREF};
    }

    public function Seller(){
        return $this->belongsTo('App\Entities\User','seller_id','id');
    }

    public function State(){
        return $this->belongsTo('App\Entities\State','state_id','id');
    }

    public function Cars(){
        return $this->hasMany('App\Entities\Car','store_id','id');
    }

    public function getSellerNameAttribute(){
        return $this->seller_id != null ? $this->Seller->name  : '';
    }

    public function getStateNameAttribute(){
        return $this->state_id != null ? $this->State->{'title_'.LANGUAGE_PREF }  : '';
    }

    public function getCityNameAttribute(){
        return $this->state_id != null && $this->State->City != null ? $this->State->City->{'title_'.LANGUAGE_PREF }  : '';
    }

    public function getCountryNameAttribute(){
        return $this->state_id != null && $this->State->City != null && $this->State->City->Country != null ? $this->State->City->Country->{'title_'.LANGUAGE_PREF }  : '';
    }

    public function setOffDaysAttribute($value){
        $this->attributes['off_days'] = $value != null ? serialize($value) : null;
    }

    public function getOffDaysArrAttribute(){
        return  $this->off_days != null ? unserialize($this->off_days) : [];
    }
}
