<?php namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {

    protected $fillable = ['user_id','car_id'];
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    protected $table = 'user_favorites';

    static function getOne($id){
        return self::where('car_id',$id)->where('user_id',USER_ID)->first();
    }

    public function Car(){
        return $this->belongsTo('App\Entities\Car','car_id','id');
    }
}
