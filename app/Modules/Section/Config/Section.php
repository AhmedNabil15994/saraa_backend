<?php

return [
         'title'=>'Section', 
         'permissions'=>  [
       'SectionController@index' => 'list-sections', 
        'SectionController@create' => 'add-section', 
        'SectionController@store' => 'add-section', 
        'SectionController@edit' => 'edit-section', 
        'SectionController@update' => 'edit-section', 
        'SectionController@fastEdit' => 'edit-section', 
        'SectionController@restore' => 'restore-section', 
        'SectionController@delete' => 'delete-section', 
        'SectionController@destroy' => 'delete-section', 
        ], 
         ];