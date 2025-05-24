<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class EmployeeStore extends Model {
    protected $fillable = ['emp_id','store_id',];

    protected $guarded = [
        // Guarded fields here
    ];

    protected $dates = [
        // Dates here
    ];

    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $table = 'employee_stores';

    public function Store(){
        return $this->belongsTo('App\Entities\Store','store_id','id');
    }
}
