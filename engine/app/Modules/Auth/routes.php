<?php

/*----------------------------------------------------------
User Auth
----------------------------------------------------------*/
Route::group(['prefix' => '/'] , function () {
    $controller = App\Http\Controllers\AuthController::class;
    Route::post('login', [$controller,'login']);
    Route::post('register', [$controller,'register']);
});
