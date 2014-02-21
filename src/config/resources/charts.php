<?php

return array(

	'table'     		=>  'charts',

	'eloquent'  		=>  'Chart',

	'data-perpage'  	=>  10,

	'title'   		=>  array(
		'index'         =>  'All Charts (%s)',
		'create'        =>  'Add New',
		'edit'          =>  'Edit Data',
		'show'          =>  'Show Data',
		'search'        =>  'Search Result : "%s"'
	),

	'search'  		=> 	['title', 'slug', 'table', 'created_at'],

	'fields'  		=> 	array(
		'show'		=>	['title', 'slug', 'table', 'created_at'],
		'format'	=>	array(
			'title'	=>	'Title',
			'slug'	=>	['URL', function($id, $data)
			{
				return link_to('admin/charts/'.$data->slug, url('admin/charts/'.$data->slug));
			}],
			'table'	=>	'Table',
			'created_at'	=>	'Created At'
		)
	),

	'validation'	=>	array(
		'create'	=>	array(
			'rules'		=>	array(),
			'messages'	=>	array(),
			'format'	=>	array(),
		),
		'update'	=>	array(
			'rules'		=>	array(),
			'messages'	=>	array(),
			'format'	=>	array()
		)
	),

	'form'    		=>  array(
		'create'	=>	array(
			'title'	=>	array(
				'title'	=>	'Title',
				'field'	=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	array(
						'class'	=>	'form-control'
					)
				)
			),
			'slug'	=>	array(
				'title'	=>	'Uri Slug',
				'field'	=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	array(
						'class'	=>	'form-control'
					)
				)
			),
			'table'	=>	array(
				'title'	=>	'Table Name',
				'field'	=>	array(
					'type'			=>	'text',
					'value'			=>	null,
					'attributes'	=>	array(
						'class'	=>	'form-control'
					)
				)
			),
		),
		'update'	=>	'auto'
	),
);