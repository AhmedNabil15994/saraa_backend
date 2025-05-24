<?php namespace App\Entities;

use App\Entities\ApiKeys;
use Illuminate\Database\Eloquent\Model;

class ApiAuth extends Model{

    protected $table = 'api_auth';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    static function logoutOtherSessions($userId, $apiKey) {
        $authList = self::where('user_id', $userId)
            ->where('api_id', $apiKey)
            ->get();

        foreach($authList as $key => $value) {
            $value->auth_expire = 0;
            $value->save();
        }

        return true;
    }

    static function checkUserToken($token) {
        
        $apiKey = ApiKeys::checkApiKey()->id;

        $authCheck = self::where('auth_token', $token)
            ->where('api_id', $apiKey)
            ->where('auth_expire', 1)
            ->first();
        
        if($authCheck == null) {
            return null;
        }

        if(!defined('USER_ID')) {
            define('USER_ID', $authCheck->user_id);
        }

        $dataObj = User::getUser();
        if($dataObj == null) {
            return null;
        }

        session(['token' => $dataObj->token]);
        session(['last_login' => $dataObj->last_login]);
        session(['user_id' => $authCheck->user_id]);
        session(['name' => $dataObj->name]);
        session(['email' => $dataObj->email]);
        session(['mobile' => $dataObj->mobile]);

        return ['user' => $dataObj, 'auth' => $authCheck, 'user_id'=>$authCheck->user_id];
    }
}
