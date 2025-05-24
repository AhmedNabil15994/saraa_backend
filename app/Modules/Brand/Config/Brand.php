<?php

return [
         'title'=>'Brand', 
         'permissions'=>  [
       'BrandController@index' => 'list-brands', 
        'BrandController@create' => 'add-brand', 
        'BrandController@store' => 'add-brand', 
        'BrandController@edit' => 'edit-brand', 
        'BrandController@update' => 'edit-brand', 
        'BrandController@fastEdit' => 'edit-brand', 
        'BrandController@restore' => 'restore-brand', 
        'BrandController@delete' => 'delete-brand', 
        'BrandController@destroy' => 'delete-brand', 
        ], 
         ];