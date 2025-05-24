<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\AuthenticationRepository as Authentication;

use App\Http\Requests\ForgetPasswordRequest;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function forgetPassword()
    {
        return view('Auth::forget');
    }

    public function sendForgetPassword(ForgetPasswordRequest $request)
    {

        $token = $this->auth->createToken($request);
        try {
            $token['user']->notify(new ResetPasswordNotification($token));
        }catch (\Exception $e){}

        return redirect()->back()->with(['status' => __('check your mail we sent a reset email for you'), 'alert' => 'success']);
    }
}
