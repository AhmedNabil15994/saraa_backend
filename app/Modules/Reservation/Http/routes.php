<?php

Route::group(['prefix' => '/dashboard/reservations' ,'middleware' => 'web'] , function () {
    $controller = App\Http\Controllers\ReservationController::class;
    Route::get('/', [$controller,'index']);
    Route::get('/paid', [$controller,'paid']);
    Route::get('/pending', [$controller,'pending']);
    Route::get('/unCompleted', [$controller,'unCompleted']);
    Route::get('/view/{id}', [$controller,'view']);
    Route::post('/update/{id}', [$controller,'update']);
    Route::get('/delete/{id}', [$controller,'delete']);
    Route::get('/destroy/{id}', [$controller,'delete']);
    Route::get('/restore/{id}', [$controller,'restore']);
});