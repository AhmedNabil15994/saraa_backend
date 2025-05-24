<?php

return [
	'title'=>'Seller',
	'permissions' => [
		'SellerController@index' => 'list-sellers', 
        'SellerController@create' => 'add-seller', 
        'SellerController@store' => 'add-seller', 
        'SellerController@edit' => 'edit-seller', 
        'SellerController@update' => 'edit-seller', 
        'SellerController@fastEdit' => 'edit-seller', 
        'SellerController@restore' => 'restore-seller', 
        'SellerController@delete' => 'delete-seller', 
        'SellerController@destroy' => 'delete-seller',
	],
];