<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarModel extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','brand_id','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'car_models';

    protected $appends = ['brand_name','title'];

    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }

    public function Brand(){
        return $this->belongsTo('App\Entities\Brand','brand_id','id');
    }

    public function getBrandNameAttribute(){
        return ($this->brand_id != null && $this->Brand) ? $this->Brand->{'title_'.LANGUAGE_PREF}  : '';
    }

}
