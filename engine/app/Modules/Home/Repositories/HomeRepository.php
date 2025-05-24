<?php

namespace App\Repositories;

use App\Entities\Brand;
use App\Entities\Car;
use App\Entities\ContactUs;
use App\Entities\Page;
use App\Entities\Slider;
use App\Entities\Store;
use App\Transformers\BrandResource;
use App\Transformers\CarResource;
use App\Transformers\{PageResource,SliderResource};
use App\Transformers\StoreResource;

class HomeRepository {

    public function getHomeData(){
        $brands = Brand::active()->NotDeleted()->orderBy('id','desc')->take(5)->get();
        $cars = Car::active()->NotDeleted()->orderBy('id','desc')->take(5)->get();
        $stores = Store::active()->NotDeleted()->orderBy('id','desc')->take(4)->get();

        $dataList['brands'] = BrandResource::collection($brands);
        $dataList['cars'] = CarResource::collection($cars);
        $dataList['stores'] = StoreResource::collection($stores);
        
        return $dataList;
    }

    public function getPages(){
        return PageResource::collection(Page::active()->with('Sections')->get());
    }

    public function getSliders(){
        return SliderResource::collection(Slider::active()->get());
    }

    public function findPage($id){
        return Page::find($id);
    }

    public function storeContactUs($request){
        $requestData = $request->validated();
        $requestData['status'] = 1;
        $requestData['phone'] = $requestData['mobile'];

        $contact = ContactUs::create($requestData);
        \MailHelper::sendMail([
            'template' => 'emailUsers.default',
            'to' => $requestData['email'],
            'subject' => trans('main.contact_us'),
        ]);
        
        return true;
    }
}
