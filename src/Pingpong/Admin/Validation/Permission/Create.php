<?php namespace Pingpong\Admin\Validation\Permission;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'name' => 'required',
	        'slug' => 'required|unique:permissions,slug'
	    ];
	}

}