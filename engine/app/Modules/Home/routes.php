<?php
Route::group(['prefix' => '/'],function(){
    $controller = App\Http\Controllers\HomeControllers::class;
    Route::get('/home', [$controller,'index']);

    Route::group(['prefix' => '/pages'],function() use ($controller){
        Route::get('/', [$controller,'pages']);
        Route::get('/{id}', [$controller,'getPage']);
    });

    Route::get('/sliders', [$controller,'sliders']);
    Route::get('/settings', [$controller,'settings']);
    Route::get('/privacy', [$controller,'privacy']);
    Route::get('/about-us', [$controller,'aboutUs']);
    
    Route::post('/contact-us', [$controller,'contactUs']);
});
    
// =============================== payments ===================================
Route::group(['prefix' => '/payment'], function () {
    $controller = App\Http\Controllers\PaymentControllers::class;
    Route::get('/success', [$controller,'success'])->name("api.payment.success");
    Route::get('/failed', [$controller,'failed'])->name("api.payment.failed");

    Route::get('/success-myfatoorah', [$controller,'successMFatoorah'])
        ->name("api.payment.myfatoorah.success");
    Route::get('/failed-myfatoorah', [$controller,'failedMFatoorah'])
        ->name("api.payment.myfatoorah.failed");
});


