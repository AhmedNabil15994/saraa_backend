<?php namespace App\Http\Controllers;

use App\Repositories\PaymentRepository as Repo;
use App\Transformers\ReservationResource;
use Illuminate\Http\Request;

class PaymentControllers extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function success(Request $request)
    {
        $result = $this->repo->successPayment($request);
        $dataList = new ReservationResource($result);
        
        return \TraitsFunc::response([
            'status' => 'success',
            'reservation' => $dataList,
        ]);
    }

    public function failed(Request $request)
    {
        $result = $this->repo->failedPayment($request);
        $dataList = new ReservationResource($result);

        return \TraitsFunc::response([
            'status' => 'failed',
            'reservation' => $dataList,
        ]);
    }

    public function successMFatoorah(Request $request)
    {
        $data = $this->repo->getTransaction($request->paymentId);
        $this->repo->successPayment($data, "myfatoorah");
        return  "success";
    }

    public function failedMFatoorah(Request $request)
    {
        $this->repo->failedPayment($request);
        return  "failed";
    }
}
