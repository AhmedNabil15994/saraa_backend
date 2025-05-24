<?php

Route::group(['prefix' => 'states'],function(){
    $controller = App\Http\Controllers\StateControllers::class;
    Route::get('/',[$controller,'index']);
});

Route::group(['prefix' => 'cities'],function(){
    $controller = App\Http\Controllers\StateControllers::class;
    Route::get('/',[$controller,'cities']);
});

