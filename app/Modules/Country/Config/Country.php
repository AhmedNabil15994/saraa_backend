<?php

return [
         'title'=>'Country', 
         'permissions'=>  [
       'CountryController@index' => 'list-countries', 
        'CountryController@create' => 'add-country', 
        'CountryController@store' => 'add-country', 
        'CountryController@edit' => 'edit-country', 
        'CountryController@update' => 'edit-country', 
        'CountryController@fastEdit' => 'edit-country', 
        'CountryController@restore' => 'restore-country', 
        'CountryController@delete' => 'delete-country', 
        'CountryController@destroy' => 'delete-country', 
        ], 
         ];