<?php namespace App\Repositories;

use App\Entities\ApiAuth;
use App\Entities\ApiKeys;
use App\Entities\Devices;
use App\Entities\User;
use App\Transformers\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthRepository {

    protected $user;
    protected $device;
    protected $api_auth;
    protected $api_keys;
    public function __construct(User $user,Devices $device, ApiAuth $api_auth, ApiKeys $api_keys) {
        $this->user = $user;
        $this->device = $device;
        $this->api_auth = $api_auth;
        $this->api_keys = $api_keys;
    }

    public function login($request){
        $input = $request->validated();

        $email = $input['username'];
        $userObj = $this->user->getLoginUser($email);
        if ($userObj == null) {
            return \TraitsFunc::error(trans('main.invalid_user'));
        }

        $checkPassword = Hash::check($input['password'], $userObj->password);
        if ($checkPassword == null) {
            return \TraitsFunc::error(trans('main.password_wrong'));
        }

        $dataObj = $this->LoginAction($userObj);
        $checkAuth = $this->api_auth->checkUserToken($dataObj->access_token);
        if($checkAuth == null){
            return $this->logout();
        }

        $this->device->applyNewDevice($checkAuth['auth']->id);
        return $dataObj;
    }

    public function LoginAction($userObj) {
        $dateTime = date('Y-m-d H:i:s');
        $apiKeyId = $this->api_keys->checkApiKey()->id;

        $ApiAuth = new $this->api_auth;
        $ApiAuth->auth_token = md5(uniqid(rand(), true));
        $ApiAuth->auth_expire = 1;
        $ApiAuth->api_id = $apiKeyId;
        $ApiAuth->user_id = $userObj->id;
        $ApiAuth->created_at = $dateTime;
        $ApiAuth->save();

        $userObj->last_login = $dateTime;
        $userObj->save();

        $token_value = $ApiAuth->auth_token;

        return (object) [
            'user' => new UserResource($userObj) ,
            'access_token' => $token_value,
            'token_type' => 'Bearer',
            'expires_at' => date('Y-m-d H:i:s',strtotime('+1 month',strtotime($dateTime)))
        ];
    }

    public function register($request){
        $input = $request->validated();
        $dateTime = date('Y-m-d H:i:s');
        $mobile = '+'.$input['calling_code'].$input['mobile'];

        $checkPhone = $this->user->NotDeleted()->where('mobile',$mobile)->first();
        if($checkPhone != null) {
            return \TraitsFunc::error(trans('main.mobile_exists'));
        }

        $checkEmail = $this->user->checkUserByEmail($input['email']);
        if($checkEmail != null) {
            return \TraitsFunc::error(trans('main.email_exists'));
        }

        $userObj = new $this->user;
        $userObj->email = $input['email'];
        $userObj->name = $input['name'];
        $userObj->mobile = $mobile;
        $userObj->status = 1;
        $userObj->role_id = 3;
        $userObj->password = Hash::make($input['password']);
        $userObj->last_login = $dateTime;
        $userObj->calling_code = '+'.$input['calling_code'];
        $userObj->created_at = $dateTime;
        $userObj->save();

        $dataObj = $this->LoginAction($userObj);

        $checkAuth = $this->api_auth->checkUserToken($dataObj->access_token);
        if($checkAuth == null){
            return $this->logout();
        }

        $this->device->applyNewDevice($checkAuth['auth']->id);
        return $dataObj;
    }

    public function logout(){
        $authObj = $this->api_auth->checkUserToken(APP_TOKEN);

        if($authObj == null){
            return \TraitsFunc::error(trans('main.invalid_process'));
        }

        $authObj['auth']->auth_expire = 0;
        $authObj['auth']->save();

        \Auth::logout();
        session()->flush();
        return true;
    }
}
