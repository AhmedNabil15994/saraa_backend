<?php

Route::group(['prefix' => 'stores'],function(){
    $controller = App\Http\Controllers\StoreControllers::class;
    Route::get('/',[$controller,'index']);
    Route::get('/{id}',[$controller,'show']);
    Route::get('/{id}/times',[$controller,'times']);
});


