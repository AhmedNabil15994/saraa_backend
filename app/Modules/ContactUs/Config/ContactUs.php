<?php

return [
         'title'=>'ContactUs', 
         'permissions'=>  [
       'ContactUsController@index' => 'list-contact-us', 
        'ContactUsController@create' => 'add-contact-us', 
        'ContactUsController@store' => 'add-contact-us', 
        'ContactUsController@edit' => 'edit-contact-us', 
        'ContactUsController@update' => 'edit-contact-us', 
        'ContactUsController@fastEdit' => 'edit-contact-us', 
        'ContactUsController@restore' => 'restore-contact-us', 
        'ContactUsController@delete' => 'delete-contact-us', 
        'ContactUsController@destroy' => 'delete-contact-us', 
        ], 
         ];