<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Repositories\StateRepository;
use Illuminate\Http\Request;

class StateControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(StateRepository $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $dataList = $this->repo->getStates();
        return \TraitsFunc::response($dataList);
    }

    public function cities() {
        $dataList = $this->repo->getCities();
        return \TraitsFunc::response($dataList);
    }
}
