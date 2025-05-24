<?php namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller {

    use \TraitsFunc;

    protected $repo;

    public function __construct(AuthRepository $repo) {
        $this->repo = $repo;
    }

	public function login(LoginRequest $request) {
        $dataObj = $this->repo->login($request);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }

		return \TraitsFunc::response($dataObj,trans('main.loginSuccess'));
	}

	public function logout() {
        $this->repo->logout();
        return \TraitsFunc::response(null,trans('main.logout_success'));
	}

    public function register(RegisterRequest $request) {
        $dataObj = $this->repo->register($request);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }

        return \TraitsFunc::response($dataObj,trans('main.register_success'));
    }

}
