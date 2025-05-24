<?php namespace App\Http\Controllers;

use App\Entities\CarType;
use App\Entities\Color;
use App\Entities\Favorite;
use App\Repositories\CarRepository;
use App\Transformers\CarResource;
use App\Transformers\CarTypeResource;
use App\Transformers\ColorResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class CarControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(CarRepository $repo) {
        $this->repo = $repo;
    }

    public function index() {
        $cars = $this->repo->filterCars();
        return \TraitsFunc::responsePagnation(CarResource::collection($cars));
    }

    public function show($id){
        $dataObj = $this->repo->getCar($id);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }

        return \TraitsFunc::response(new CarResource($dataObj));
    }

    public function toggleFavorite($id){
        $dataObj = $this->repo->getCar($id);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }

        $flag = false;
        $message = trans('main.car_removed');
        $favouriteObj = Favorite::getOne($id);
        if(!$favouriteObj){
            $flag = true;
            $message = trans('main.car_added');

            $favouriteObj = new Favorite();
            $favouriteObj->user_id = USER_ID;
            $favouriteObj->car_id = $id;
            $favouriteObj->save();
        }else{
            $favouriteObj->delete();
        }
        return \TraitsFunc::response([
            'added' => $flag,
        ],$message);        
    }   

    public function attributes($id){
        $car = $this->repo->getCar($id);
        if($car instanceof JsonResponse){
            return $car;
        }

        return \TraitsFunc::response([
            new ColorResource($car->Color),
            new CarTypeResource($car->CarType),
            ['key' => 'year'  ,'title' => trans('main.year') ,'value'=> $car->year],
            ['key' => 'model' ,'title' => trans('main.model') ,'value'=> $car->model_name],
            ['key' => 'brand' ,'title' => trans('main.brand') ,'value'=> $car->brand_name],
        ]);
    }

    public function prices($id){
        $car = $this->repo->getCar($id);
        if($car instanceof JsonResponse){
            return $car;
        }

        $input = \Request::all();
        if(!isset($input['reserve_from']) || empty($input['reserve_from'])){
            return \TraitsFunc::error(trans('main.reserve_from_required'));
        }

        if(!isset($input['reserve_to']) || empty($input['reserve_to'])){
            return \TraitsFunc::error(trans('main.reserve_to_required'));
        }

        $days = round((strtotime($input['reserve_to']) - strtotime($input['reserve_from'])) / (60 * 60) / 24);
        $price = \Helper::calcCarReservationDaysPrice($days,$car->prices_arr);
        
        return \TraitsFunc::response([
            'from' => $input['reserve_from'],
            'to' => $input['reserve_to'],
            'days' => $days,
            'price_label' =>  (string)round( ($price / $days) ,2) ,
            'price' => (string) $price,
        ]);        
    }

    public function colors(){
        $data = ColorResource::collection(Color::active()->get());
        return \TraitsFunc::response($data);
    }

    public function types(){
        $data = CarTypeResource::collection(CarType::active()->get());
        return \TraitsFunc::response($data);
    }
}
