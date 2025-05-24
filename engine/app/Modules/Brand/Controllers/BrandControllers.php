<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Repositories\BrandRepository;
use App\Transformers\CarResource;
use Illuminate\Http\Request;

class BrandControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(BrandRepository $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $dataList = $this->repo->getBrands();
        return \TraitsFunc::response($dataList);
    }
}
