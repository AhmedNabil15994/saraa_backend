<?php

return [
	'title'=>'Employees', 
	'newOne' => 'Add New Employee', 
	'form' => [
		'name' => 'Name',
		'status' => 'Status',
		'mobile' => 'Phone',
		'email' => 'E-Mail',
		'password' => 'Password',
		'password_confirmation' => 'Password Confirmation',
		'role' => 'Role',
		'last_login' => 'Last Login',
		'extra_permissions' => 'Extra Permissions',
		'first_name' => 'First Name',
		'last_name' => 'Last Name',
		'image' => 'Image',
		'change_image_p' => 'Change Employee Image',
		'validations' => [
			'email_required' => 'Email is required!',
			'email_email' => 'Email Format is Incorrect!',
			'email_unique' => 'Email has been already used!',
			'name_required' => 'Name is required!',
			'mobile_required' => 'Phone is required!',
			'mobile_unique' => 'Phone has been already used!',
			'role_id_unique' => 'Role is required!',
			'password_required' => 'Password is required!',
			'password_confirmed' => 'Passwords are not the same!',
			'password_min' => 'Password must be at least 6 characters!',
		],
	], 
];