<?php

return [
	'title'=>'Clients',
	'permissions' => [
		'ClientController@index' => 'list-clients', 
        'ClientController@create' => 'add-client', 
        'ClientController@store' => 'add-client', 
        'ClientController@edit' => 'edit-client', 
        'ClientController@update' => 'edit-client', 
        'ClientController@fastEdit' => 'edit-client', 
        'ClientController@restore' => 'restore-client', 
        'ClientController@delete' => 'delete-client', 
        'ClientController@destroy' => 'delete-client',
	],
];