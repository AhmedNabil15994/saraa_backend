<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Abstracts\ModuleManager;

use App\Entities\Store;
use App\Entities\Car;
use App\Entities\User;
use App\Entities\Reservation;
use DB;
class DashboardController extends Controller{

	public function __construct(ModuleManager $manager)
    {
        $this->manager = $manager;
    }

	public function index()
	{
        $counts['stores']= Store::active()->count();
        $counts['cars']= Car::active()->count();
        $counts['sellers']= User::active()->whereRoleId('2')->count();
        $counts['clients']= User::active()->whereRoleId('3')->count();

        $counts['all_orders']= Reservation::count();
        $counts['paid_orders']= Reservation::where('status',1)->count();
        $counts['pending_orders']= Reservation::where('status',2)->count();
        $counts['uncompleted_orders']= Reservation::where('status',0)->count();

        $counts['today_profit'] = Reservation::active()->whereBetween('created_at',[date('Y-m-d').' 00:00:00' , date('Y-m-d'). ' 23:59:59'])->sum('price');
        $counts['month_profit'] = Reservation::active()->whereBetween('created_at',[date('Y-m-1').' 00:00:00' , date('Y-m-t'). ' 23:59:59'])->sum('price');
        $counts['year_profit'] = Reservation::active()->whereBetween('created_at',[date('Y-1-1').' 00:00:00' , date('Y-12-t'). ' 23:59:59'])->sum('price');
        $counts['total_profit'] = Reservation::active()->sum('price');

        $counts['month_reservations'] = Reservation::select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year','month')->get('data');
        $counts['month_clients'] = User::active()->whereRoleId('3')->select(DB::raw('count(id) as `data`'),DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year','month')->get('data');

		return view('Dashboard::index',compact('counts'));
	}

	public function postPublish($group = null)
    {
        $json = false;
        if($group === '_json'){
            $json = true;
        }
        $modules = config('modules.modules');
        if(in_array($group,$modules)){
        	$this->manager->exportTranslations($group,$json,true);
        }else{
	        $this->manager->exportTranslations($group, $json);
        }
        return ['status' => 'ok'];
    }

}