<?php namespace App\Repositories;

use App\Entities\ApiAuth;
use App\Entities\User;
use App\Transformers\UserResource;
use Illuminate\Support\Facades\Hash;

class UserRepository {

    protected $user;
    protected $api_auth;
    public function __construct(User $user, ApiAuth $api_auth) {
        $this->user = $user;
        $this->api_auth = $api_auth;
    }

    public function getUser(){
        $userObj = $this->user->getOne(USER_ID);
        if ($userObj == null) {
            return \TraitsFunc::error(trans('main.notFound'));
        }
        $checkAuth = $this->api_auth->checkUserToken(APP_TOKEN);

        return new UserResource($userObj);
    }

    public function updateUser($request){
        $userObj = $this->user->getOne(USER_ID);
        if ($userObj == null) {
            return \TraitsFunc::error(trans('main.notFound'));
        }

        $input = $request->all();

        if(isset($input['name']) && !empty($input['name'])){
            $userObj->name = $input['name'];
        }

        if(isset($input['email']) && !empty($input['email'])){
            $checkPhone = $this->user->checkUserByEmail($input['email'],USER_ID);
            if($checkPhone != null) {
                return \TraitsFunc::error(trans('main.email_exists'));
            }
            $userObj->email = $input['email'];
        }

        if(isset($input['mobile']) && !empty($input['mobile']) && isset($input['calling_code']) && !empty($input['calling_code'])){
            $mobile = '+'.$input['calling_code'].$input['mobile'];
            $checkPhone = $this->user->checkUserByPhone($mobile,USER_ID);
            if($checkPhone != null) {
                return \TraitsFunc::error(trans('main.mobile_exists'));
            }
            $userObj->mobile = $mobile;
            $userObj->calling_code = '+'.$input['calling_code'];
        }

        if(isset($input['old_password']) && !empty($input['old_password'])){
            $checkPassword = Hash::check($input['old_password'], $userObj->password);
            if ($checkPassword == null) {
                return \TraitsFunc::error(trans('main.old_password_wrong'));
            }

            $userObj->password = Hash::make($input['password']);
        }

        return $userObj->save();
    }

    public function deactivate(){
        $userObj = $this->user->getOne(USER_ID);
        if ($userObj == null) {
            return \TraitsFunc::error(trans('main.notFound'));
        }

        $authObj = $this->api_auth->checkUserToken(APP_TOKEN);
        if($authObj == null){
            return \TraitsFunc::error(trans('main.invalid_process'));
        }
        $authObj['auth']->auth_expire = 0;
        $authObj['auth']->save();

        $userObj->status = 0;
        $userObj->save();

        session()->flush();
        return true;
    }
}
