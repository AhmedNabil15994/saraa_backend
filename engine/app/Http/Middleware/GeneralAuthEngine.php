<?php namespace App\Http\Middleware;

use App\Entities\ApiKeys;
use Closure;
use Illuminate\Support\Facades\Session;

class GeneralAuthEngine
{

    public function handle($request, Closure $next){
        if(in_array(\Request::segment(1),['payment','uploads'])){
            define('LANGUAGE_PREF','ar');
            return $next($request);
        }
        if (!isset($_SERVER['HTTP_APIKEY'])) {
            return \TraitsFunc::error(trans('main.api_invalid'),[],404);
        }

        $apiKey = $_SERVER['HTTP_APIKEY'];
        $getAPIKey = ApiKeys::checkApiKey();
        if ($getAPIKey == null) {
            return \TraitsFunc::error(trans('main.api_invalid2'),[],404);
        }

        $lang = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) && $_SERVER['HTTP_ACCEPT_LANGUAGE'] != '' ? $_SERVER['HTTP_ACCEPT_LANGUAGE']: 'ar';
        \App::setLocale($lang);

        define('LANGUAGE_PREF',\App::getLocale());
        define('API_KEY', $apiKey);
        return $next($request);
    }
}
