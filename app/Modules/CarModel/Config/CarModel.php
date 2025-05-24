<?php

return [
         'title'=>'CarModel', 
         'permissions'=>  [
       'CarModelController@index' => 'list-carModels', 
        'CarModelController@create' => 'add-carModel', 
        'CarModelController@store' => 'add-carModel', 
        'CarModelController@edit' => 'edit-carModel', 
        'CarModelController@update' => 'edit-carModel', 
        'CarModelController@fastEdit' => 'edit-carModel', 
        'CarModelController@restore' => 'restore-carModel', 
        'CarModelController@delete' => 'delete-carModel', 
        'CarModelController@destroy' => 'delete-carModel', 
        ], 
         ];