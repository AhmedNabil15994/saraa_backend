<?php

return [
         'title'=>'Year', 
         'permissions'=>  [
       'YearController@index' => 'list-years', 
        'YearController@create' => 'add-year', 
        'YearController@store' => 'add-year', 
        'YearController@edit' => 'edit-year', 
        'YearController@update' => 'edit-year', 
        'YearController@fastEdit' => 'edit-year', 
        'YearController@restore' => 'restore-year', 
        'YearController@delete' => 'delete-year', 
        'YearController@destroy' => 'delete-year', 
        ], 
         ];