<?php

return [
         'title'=>'Store', 
         'permissions'=>  [
       'StoreController@index' => 'list-stores', 
        'StoreController@create' => 'add-store', 
        'StoreController@store' => 'add-store', 
        'StoreController@edit' => 'edit-store', 
        'StoreController@update' => 'edit-store', 
        'StoreController@fastEdit' => 'edit-store', 
        'StoreController@restore' => 'restore-store', 
        'StoreController@delete' => 'delete-store', 
        'StoreController@destroy' => 'delete-store', 
        ], 
         ];