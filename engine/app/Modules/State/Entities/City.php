<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','country_id','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'cities';

    protected $appends = ['country_name','title'];

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function Country(){
        return $this->belongsTo('App\Entities\Country','country_id','id');
    }

    public function getCountryNameAttribute(){
        return $this->country_id != null ? $this->Country->{'title_'.LANGUAGE_PREF}  : '';
    }

    public function States(){
        return $this->hasMany('App\Entities\State','city_id','id');
    }
}
