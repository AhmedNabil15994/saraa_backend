<?php namespace App\Http\Middleware;

use App\Entities\ApiAuth;
use App\Entities\ApiKeys;
use App\Entities\User;
use Closure;
use Illuminate\Support\Facades\Session;

class AuthEngine
{

    public function handle($request, Closure $next){
        $apiAuthToken = request()->bearerToken();
        if (!$apiAuthToken) {
            return \TraitsFunc::unauthenticated();
        }

        if ($request->segment(1) == null && $apiAuthToken != '') {
            return \TraitsFunc::unauthenticated();
        }

        if (in_array($request->segment(1), ['login', 'register'])) {
            return \TraitsFunc::unauthenticated();
        }

        //Check token
        $checkAuth = ApiAuth::checkUserToken($apiAuthToken);
        if($checkAuth == null){
            \Auth::logout();
            session()->flush();
            return \TraitsFunc::error(trans('main.session_expired'),[],404);
        }

        define('APP_TOKEN', $apiAuthToken);
        return $next($request);
    }
}
