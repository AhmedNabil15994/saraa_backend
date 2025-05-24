<?php

return [
	'title'=>'Role',
	'permissions' => [
		'RoleController@index' => 'list-roles', 
        'RoleController@create' => 'add-role', 
        'RoleController@store' => 'add-role', 
        'RoleController@edit' => 'edit-role', 
        'RoleController@update' => 'edit-role', 
        'RoleController@fastEdit' => 'edit-role', 
        'RoleController@restore' => 'restore-role', 
        'RoleController@delete' => 'delete-role', 
        'RoleController@destroy' => 'delete-role', 
	],
];