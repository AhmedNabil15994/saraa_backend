<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','description_ar','description_en','seller_id','image','state_id','address_ar','address_en','off_days','work_from','work_to','lat','lng','contact_info','status','created_at','updated_at','deleted_at',];

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

    protected $appends = ['image_url','work_from_arr','work_to_arr','seller_name','state_name','country_name','address','city_name','title','description','off_days_arr'];

    public function getImageUrlAttribute(){
        return \FilesHelper::getImagePath('stores',$this->id,$this->image,true);
    }

    public function setWorkFromAttribute($value){
        return $this->attributes['work_from'] = json_encode($value);
    }

    public function setWorkToAttribute($value){
        return $this->attributes['work_to'] = json_encode($value);
    }

    public function getWorkFromArrAttribute(){
        return $this->work_from != null ? (array)json_decode($this->work_from) : [];
    }

    public function getWorkToArrAttribute(){
        return $this->work_to != null ? (array)json_decode($this->work_to) : [];
    }

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function getDescriptionAttribute(){
        return $this->{'description_'.LANGUAGE_PREF};
    }

    public function getAddressAttribute(){
        return $this->{'address_'.LANGUAGE_PREF};
    }

    public function Seller(){
        return $this->belongsTo('App\Entities\User','seller_id','id');
    }

    public function EmployeeStores(){
        return $this->hasMany('App\Entities\EmployeeStore','store_id','id');
    }

    public function Employees(){
        return $this->belongsToMany('App\Entities\User', 'employee_stores','store_id','emp_id')->withPivot(['emp_id']);
    }

    public function State(){
        return $this->belongsTo('App\Entities\State','state_id','id');
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
