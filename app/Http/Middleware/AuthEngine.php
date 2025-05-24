<?php

namespace App\Http\Middleware;
use App\Entities\User;
use Illuminate\Support\Facades\Session;
use Closure;

class AuthEngine
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next){
        define('USER_ID', Session::get('user_id'));
        if (in_array($request->segment(2), ['changeLang'])) {
            return $next($request);
        }
        
        if ($request->segment(1) == null && !(USER_ID && USER_ID != '')) {
            session()->flush();

            \Session::flash('error', trans('Auth::login.validations.mustLogin'));
            return Redirect('/dashboard/login');
        }

        if (!(USER_ID && USER_ID != '')) {
            session()->flush();

            \Session::flash('error', trans('Auth::login.validations.mustLogin'));
            return Redirect('/dashboard/login');
        }

        
        define('ROLE_ID', Session::get('role_id'));
        $userObj = User::with('UserRole')->find(USER_ID);
        $permissions = $userObj->checkUserPermissions($userObj);
        define('ROLE', $userObj->role_name);
        define('IMAGE', $userObj->image_url);

        define('IS_ADMIN', $userObj->role_id == 1 ? true : false);
        define('PERMISSIONS', $permissions);
        define('NAME', $userObj->name);
        return $next($request);
    }
}
