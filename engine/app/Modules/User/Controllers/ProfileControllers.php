<?php namespace App\Http\Controllers;

use App\Entities\ApiAuth;
use App\Entities\Car;
use App\Entities\Favorite;
use App\Entities\User;
use App\Http\Requests\UpdatePasswordRequest;
use App\Repositories\UserRepository;
use App\Transformers\CarResource;
use App\Transformers\FavoriteResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileControllers extends Controller {

    use \TraitsFunc;

    protected $repo;
    public function __construct(UserRepository $repo) {
        $this->repo = $repo;
    }

    public function getUserData() {
        $dataObj = $this->repo->getUser();
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }
        return \TraitsFunc::response($dataObj);
    }

    public function updateUserData(Request $request){
        $dataObj = $this->repo->updateUser($request);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }
        return \TraitsFunc::response(null,trans('main.data_updated'));
    }

    public function changePassword(UpdatePasswordRequest $request){
        $dataObj = $this->repo->updateUser($request);
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }
        
        return \TraitsFunc::response(null,trans('main.password_updated'));
    }

    public function deactivate(){
        $dataObj = $this->repo->deactivate();
        if($dataObj instanceof JsonResponse){
            return $dataObj;
        }
        return \TraitsFunc::response([
            'deactivated' => $dataObj
        ]);
    }

    public function favorites(Request $request){
        $data = Favorite::where('user_id',USER_ID)->whereHas('Car')->with('Car')->orderBy('id','DESC')->paginate($request->per_page??10);
        return \TraitsFunc::responsePagnation(FavoriteResource::collection($data));
    }
}
