<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['title_ar','title_en','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'countries';

    protected $appends = ['title'];
    
    public function getTitleAttribute(){
        return $this->{'title_'.LANGUAGE_PREF};
    }
}
