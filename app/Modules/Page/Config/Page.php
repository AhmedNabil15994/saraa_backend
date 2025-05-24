<?php

return [
         'title'=>'Page', 
         'permissions'=>  [
       'PageController@index' => 'list-pages', 
        'PageController@create' => 'add-page', 
        'PageController@store' => 'add-page', 
        'PageController@edit' => 'edit-page', 
        'PageController@update' => 'edit-page', 
        'PageController@fastEdit' => 'edit-page', 
        'PageController@restore' => 'restore-page', 
        'PageController@delete' => 'delete-page', 
        'PageController@destroy' => 'delete-page', 
        ], 
         ];