<?php

return [
	'title'=>'EmployeeRole',
	'permissions' => [
		'EmployeeRoleController@index' => 'list-employee-roles', 
        'EmployeeRoleController@create' => 'add-employee-role', 
        'EmployeeRoleController@store' => 'add-employee-role', 
        'EmployeeRoleController@edit' => 'edit-employee-role', 
        'EmployeeRoleController@update' => 'edit-employee-role', 
        'EmployeeRoleController@fastEdit' => 'edit-employee-role', 
        'EmployeeRoleController@restore' => 'restore-employee-role', 
        'EmployeeRoleController@delete' => 'delete-employee-role', 
        'EmployeeRoleController@destroy' => 'delete-employee-role', 
	],
];