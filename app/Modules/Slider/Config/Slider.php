<?php

return [
         'title'=>'Slider', 
         'permissions'=>  [
       'SliderController@index' => 'list-sliders', 
        'SliderController@create' => 'add-slider', 
        'SliderController@store' => 'add-slider', 
        'SliderController@edit' => 'edit-slider', 
        'SliderController@update' => 'edit-slider', 
        'SliderController@fastEdit' => 'edit-slider', 
        'SliderController@restore' => 'restore-slider', 
        'SliderController@delete' => 'delete-slider', 
        'SliderController@destroy' => 'delete-slider', 
        ], 
         ];