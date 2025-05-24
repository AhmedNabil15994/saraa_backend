<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\EloquentUserRepository;
use App\Repositories\UserCrudRepository;
use Illuminate\Http\Request;

class ProfileController extends Controller{
    protected $userRepo;
    protected $userCrud;

    public function __construct(EloquentUserRepository $userRepo,UserCrudRepository  $userCrud) {
        $this->userRepo = $userRepo;
        $this->userCrud = $userCrud;
    }

	public function index()
	{
		$user = $this->userRepo->getById(USER_ID);
		if(!$user){
            return redirect(404);
        }
        $designElems = $this->userCrud->getSpecificData(['main']);
        $designElems['mainData']['title'] = trans('Dashboard::dashboard.profile');
		return view('Dashboard::profile.index',compact('designElems','user'));
	}

	public function update(Request $request) {
		$request['role_id'] = ROLE_ID;
        $user = $this->userRepo->update($request,USER_ID);
        if(!$user){
            \Session::flash('error',$this->userRepo->errors->first());
            return redirect()->back()->withInput();
        }

        \Session::flash('success',trans('Dashboard::dashboard.editSuccess'));
        return redirect()->back();
    }

}