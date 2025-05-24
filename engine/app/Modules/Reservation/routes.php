<?php

Route::group(['prefix' => 'reservations'],function(){
    $controller = App\Http\Controllers\ReservationControllers::class;
    Route::get('/',[$controller,'index']);
    Route::get('/{id}',[$controller,'show']);
    Route::post('/',[$controller,'create']);
    Route::post('/checkCoupon',[$controller,'checkCoupon']);
    Route::post('/{id}/cancel',[$controller,'cancel']);
});


