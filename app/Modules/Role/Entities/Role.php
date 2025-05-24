<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model {
    use SoftDeletes,\TraitsFunc;
    protected $fillable = ['name_ar','name_en','permissions','status','created_at','created_by','updated_at','deleted_at',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    protected $table = 'roles';

    protected $appends = ['name','creator_name'];

    public function getNameAttribute(){
        return $this->{'name_'.LANGUAGE_PREF};
    }

    public function Creator(){
        return $this->belongsTo('App\Entities\User', 'created_by', 'id');
    }

    public function getCreatorNameAttribute(){
        return $this->created_by != null ? $this->Creator->name :'';
    }
}
