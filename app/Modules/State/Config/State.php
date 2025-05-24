<?php

return [
         'title'=>'State', 
         'permissions'=>  [
       'StateController@index' => 'list-states', 
        'StateController@create' => 'add-state', 
        'StateController@store' => 'add-state', 
        'StateController@edit' => 'edit-state', 
        'StateController@update' => 'edit-state', 
        'StateController@fastEdit' => 'edit-state', 
        'StateController@restore' => 'restore-state', 
        'StateController@delete' => 'delete-state', 
        'StateController@destroy' => 'delete-state', 
        ], 
         ];