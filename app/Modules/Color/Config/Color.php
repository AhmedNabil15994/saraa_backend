<?php

return [
         'title'=>'Color', 
         'permissions'=>  [
       'ColorController@index' => 'list-colors', 
        'ColorController@create' => 'add-color', 
        'ColorController@store' => 'add-color', 
        'ColorController@edit' => 'edit-color', 
        'ColorController@update' => 'edit-color', 
        'ColorController@fastEdit' => 'edit-color', 
        'ColorController@restore' => 'restore-color', 
        'ColorController@delete' => 'delete-color', 
        'ColorController@destroy' => 'delete-color', 
        ], 
         ];