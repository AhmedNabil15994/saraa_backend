<?php

Route::group(['prefix' => 'brands'],function(){
    $controller = App\Http\Controllers\BrandControllers::class;
    Route::get('/',[$controller,'index']);
});


