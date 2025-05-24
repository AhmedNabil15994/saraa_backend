<?php

return [
         'title'=>'Category', 
         'permissions'=>  [
       'CategoryController@index' => 'list-categories', 
        'CategoryController@create' => 'add-category', 
        'CategoryController@store' => 'add-category', 
        'CategoryController@edit' => 'edit-category', 
        'CategoryController@update' => 'edit-category', 
        'CategoryController@fastEdit' => 'edit-category', 
        'CategoryController@restore' => 'restore-category', 
        'CategoryController@delete' => 'delete-category', 
        'CategoryController@destroy' => 'delete-category', 
        ], 
         ];