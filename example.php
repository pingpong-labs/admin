<?php

return array(

  'table'     =>  'users',
  
  'eloquent'  =>  'User',
  
	'data-perpage'	=>	10,
	
	'title'			=>	[
		'index'		=>	'All Data (%s)',
		'create'	=>	'Add New',
		'edit'		=>	'Edit Data',
		'show'		=>	'Show Data',
		'search'	=>	'Search Result : "%s"'
	],
	
	'search' =>	['fullname', 'username', 'email'],
	
	'fields'		=>	[
		'show'		=> '*',
		'format'	=>	[
			'id'		=>	'ID',
			'fullname'	=>	'Name',
			'username'	=>	'Username',
			'email'		=>	'Email',
			'created_at'	=>	function($value){
			    $date = new Datetime($value);
			    return $date->format("Y/m/d H:i:s");
			},
			'updated_at'	=>	'Updated At'
		]
	],
	'validation'	=>	[
		'create'	=>	[
			'rules'		=>	[
				'fullname'		=>	'required',
				'username'		=>	'required|min:5|max:20|unique:users,username',
				'email'			=>	'required|email|unique:users,email',
			],
			'messages'	=>	[],
		],
		'update'	=>	[
			'rules'		=>	[
				'fullname'		=>	'required',
				'username'		=>	'required|min:5|max:20',
				'email'			=>	'required|email',
			],
			'messages'	=>	[]
		]
	],
	
	'form'	=>	[
		'create'	=>	[
		  'fullname'	=>	array(
				'title'		=>	'Name',
				'field'		=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	['class'	=>	'form-control']
				)
			),

			'username'	=>	array(
				'title'		=>	'Username',
				'field'		=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	['class'	=>	'form-control']
				)
			),

			'email'	=>	array(
				'title'		=>	'Email',
				'field'		=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	['class'	=>	'form-control']
				)
			),
		],
		'update'  =>  'auto'
	],
	
);
