<?php

return [
	'title'=>'Employees',
	'permissions' => [
		'EmployeeController@index' => 'list-employees', 
        'EmployeeController@create' => 'add-employee', 
        'EmployeeController@store' => 'add-employee', 
        'EmployeeController@edit' => 'edit-employee', 
        'EmployeeController@update' => 'edit-employee', 
        'EmployeeController@fastEdit' => 'edit-employee', 
        'EmployeeController@restore' => 'restore-employee', 
        'EmployeeController@delete' => 'delete-employee', 
        'EmployeeController@destroy' => 'delete-employee',
	],
];