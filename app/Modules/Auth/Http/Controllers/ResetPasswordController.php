<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\AuthenticationRepository as AuthenticationRepo;
use App\Entities\PasswordReset;

use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ResetPasswordController extends Controller
{

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function resetPassword(Request $request, $token)
    {
        $user = PasswordReset::where('token',$token)->first();
        if(!$user){
            abort(404);
        }
        $email = $user->email;
        return view('Auth::password_reset', compact('email', 'token','request'));
    }


    public function updatePassword(ResetPasswordRequest $request)
    {
        $reset = $this->auth->resetPassword($request);
        if($reset){
            session(['user_id' => $reset->id]);
            session(['role_id' => $reset->role_id]);
            $reset->last_login = date('Y-m-d H:i:s');
            $reset->save();
        }
        Session::flash('success', trans('Auth::login.welcome') . ucwords($reset->name));
        return redirect()->to('/dashboard');
    }
}
