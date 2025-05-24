<?php

Route::group(['prefix' => '/profile'],function(){
    $controller = App\Http\Controllers\ProfileControllers::class;

    Route::get('/', [$controller,'getUserData']);
    Route::get('/favorites', [$controller,'favorites']);
	Route::post('/', [$controller,'updateUserData']);
	Route::post('/deactivate', [$controller,'deactivate']);
	Route::post('/changePassword', [$controller,'changePassword']);
	

	Route::post('/logout', [App\Http\Controllers\AuthController::class,'logout']);
});



	
