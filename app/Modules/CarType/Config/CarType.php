<?php

return [
         'title'=>'CarType', 
         'permissions'=>  [
       'CarTypeController@index' => 'list-car-types', 
        'CarTypeController@create' => 'add-car-type', 
        'CarTypeController@store' => 'add-car-type', 
        'CarTypeController@edit' => 'edit-car-type', 
        'CarTypeController@update' => 'edit-car-type', 
        'CarTypeController@fastEdit' => 'edit-car-type', 
        'CarTypeController@restore' => 'restore-car-type', 
        'CarTypeController@delete' => 'delete-car-type', 
        'CarTypeController@destroy' => 'delete-car-type', 
        ], 
         ];