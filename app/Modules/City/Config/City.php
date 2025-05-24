<?php

return [
         'title'=>'City', 
         'permissions'=>  [
       'CityController@index' => 'list-cities', 
        'CityController@create' => 'add-city', 
        'CityController@store' => 'add-city', 
        'CityController@edit' => 'edit-city', 
        'CityController@update' => 'edit-city', 
        'CityController@fastEdit' => 'edit-city', 
        'CityController@restore' => 'restore-city', 
        'CityController@delete' => 'delete-city', 
        'CityController@destroy' => 'delete-city', 
        ], 
         ];