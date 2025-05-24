<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Repositories\StoreRepository;
use App\Transformers\StoreResource;
use App\Transformers\CarResource;
use Illuminate\Http\Request;

class StoreControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(StoreRepository $repo) {
        $this->repo = $repo;
    }

    public function index(Request $request) {
        $dataList = $this->repo->filterStores($request);
        return \TraitsFunc::responsePagnation(StoreResource::collection($dataList));
    }

    public function show($id){
        $id = (int) $id;
        $store = $this->repo->getStore($id);
        if(!$store){
            return \TraitsFunc::error(trans('main.notFound'));
        }
        $dataList = new StoreResource($store);
        return \TraitsFunc::response($dataList);
    }

    public function times($id){
        $id = (int) $id;
        $store = $this->repo->getStore($id);
        if(!$store){
            return \TraitsFunc::error(trans('main.notFound'));
        }
        $timesArr = [];
        $days = ['sat','sun','mon','tues','wed','thur','fri'];
        for ($i=0; $i < count($days); $i++) { 
            $timesArr[] = [
                'day' => trans('main.'.$days[$i]),
                'from' => $store->work_from_arr != null && $store->work_from_arr[$days[$i]] ? $store->work_from_arr[$days[$i]] : '',
                'to' => $store->work_to_arr != null ? $store->work_to_arr[$days[$i]] : '',
                'closed' => $store->work_to_arr != null && $store->work_to_arr[$days[$i]] ? false : true,
            ];
        }
        return \TraitsFunc::response($timesArr);
    }
}
