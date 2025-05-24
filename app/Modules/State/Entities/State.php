<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','city_id','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'states';

    protected $appends = ['city_name','title','country_name'];

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function City(){
        return $this->belongsTo('App\Entities\City','city_id','id');
    }

    public function getCityNameAttribute(){
        return $this->city_id != null ? $this->City->{'title_'.LANGUAGE_PREF}  : '';
    }

    public function getCountryNameAttribute(){
        return $this->City != null && $this->City->Country != null ? $this->City->Country->{'title_'.LANGUAGE_PREF}  : '';
    }

}
