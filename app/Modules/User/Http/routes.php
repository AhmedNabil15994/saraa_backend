<?php

Route::group(['prefix' => '/dashboard/users' ,'middleware' => 'web'] , function () {
    $controller = App\Http\Controllers\UserController::class;
    Route::get('/', [$controller,'index']);
    Route::get('/add', [$controller,'create']);
	Route::post('/create', [$controller,'store']);
    Route::get('/edit/{id}', [$controller,'edit']);
    Route::post('/update/{id}', [$controller,'update']);
    Route::get('/delete/{id}', [$controller,'delete']);
    Route::get('/destroy/{id}', [$controller,'delete']);
    Route::get('/restore/{id}', [$controller,'restore']);
    Route::post('/fastEdit', [$controller,'fastEdit']);
    Route::post('/uploadImg', [$controller,'uploadImg']);    
});