<?php

return [
	'title'=>'User',
	'permissions' => [
		'UserController@index' => 'list-users', 
        'UserController@create' => 'add-user', 
        'UserController@store' => 'add-user', 
        'UserController@edit' => 'edit-user', 
        'UserController@update' => 'edit-user', 
        'UserController@fastEdit' => 'edit-user', 
        'UserController@restore' => 'restore-user', 
        'UserController@delete' => 'delete-user', 
        'UserController@destroy' => 'delete-user',
	],
];