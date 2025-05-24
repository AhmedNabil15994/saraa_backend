<?php

return [
         'title'=>'Car', 
         'permissions'=>  [
       'CarController@index' => 'list-cars', 
        'CarController@create' => 'add-car', 
        'CarController@store' => 'add-car', 
        'CarController@edit' => 'edit-car', 
        'CarController@update' => 'edit-car', 
        'CarController@fastEdit' => 'edit-car', 
        'CarController@restore' => 'restore-car', 
        'CarController@delete' => 'delete-car', 
        'CarController@destroy' => 'delete-car', 
        ], 
         ];