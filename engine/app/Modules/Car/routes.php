<?php

Route::group(['prefix' => 'cars'],function(){
    $controller = App\Http\Controllers\CarControllers::class;
    Route::get('/',[$controller,'index']);
    Route::get('/{id}',[$controller,'show']);
    Route::post('/{id}/toggleFavorite',[$controller,'toggleFavorite'])->middleware('api');
    Route::get('/{id}/prices',[$controller,'prices']);
    Route::get('/{id}/attributes',[$controller,'attributes']);
});

Route::get('/colors',[App\Http\Controllers\CarControllers::class,'colors']);
Route::get('/types',[App\Http\Controllers\CarControllers::class,'types']);
