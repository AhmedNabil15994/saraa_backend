<?php namespace App\Http\Controllers;

use App\Entities\Section;
use App\Http\Requests\ContactUsRequest;
use App\Repositories\HomeRepository;
use App\Transformers\PageResource;
use App\Transformers\SectionResource;
use App\Transformers\SettingResource;
use Illuminate\Http\JsonResponse;

class HomeControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(HomeRepository $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $dataList = $this->repo->getHomeData();
        return \TraitsFunc::response($dataList);
    }

    public function pages() {
        $dataList = $this->repo->getPages();
        return \TraitsFunc::response($dataList);
    }

    public function sliders() {
        $dataList = $this->repo->getSliders();
        return \TraitsFunc::response($dataList);
    }

    public function getPage($id) {
        $dataList = $this->repo->findPage((int) $id);
        if(!$dataList){
            return \TraitsFunc::error(trans('main.notFound'));
        }
        return \TraitsFunc::response(new PageResource($dataList));
    }

    public function settings(){
        $path = base_path().'/../../app.saraakw.com/config/modules.php';
        $data = require_once($path);
        $configs1 = isset($data) && isset($data['site_configs']) && !empty($data['site_configs'])  ? $data['site_configs'] : [];
        $configs2 = isset($data) && isset($data['general_configs']) && !empty($data['general_configs'])  ? $data['general_configs'] : [];
        $settings =  array_merge($configs1,$configs2);
        return \TraitsFunc::response(new SettingResource($settings));
    }

    public function contactUs(ContactUsRequest $request){
        $dataObj = $this->repo->storeContactUs($request);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }
        return \TraitsFunc::response(null,trans('main.sent_success'));
    }

    public function privacy(){
        $dataList = new SectionResource(Section::active()->NotDeleted()->where('page_id',1)->first());
        return \TraitsFunc::response($dataList);
    }

    public function aboutUs(){
        $dataList = new SectionResource(Section::active()->NotDeleted()->where('page_id',2)->first());
        return \TraitsFunc::response($dataList);
    }
}
