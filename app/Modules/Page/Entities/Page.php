<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['name_ar','name_en','status','created_at','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'pages';

    protected $appends = ['name'];

    public function getNameAttribute(){
        return $this->{'name_'.LANGUAGE_PREF};
    }


}
