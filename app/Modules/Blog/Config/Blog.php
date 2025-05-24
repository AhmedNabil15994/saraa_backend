<?php

return [
         'title'=>'Blog', 
         'permissions'=>  [
       'BlogController@index' => 'list-blogs', 
        'BlogController@create' => 'add-blog', 
        'BlogController@store' => 'add-blog', 
        'BlogController@edit' => 'edit-blog', 
        'BlogController@update' => 'edit-blog', 
        'BlogController@fastEdit' => 'edit-blog', 
        'BlogController@restore' => 'restore-blog', 
        'BlogController@delete' => 'delete-blog', 
        'BlogController@destroy' => 'delete-blog', 
        ], 
         ];