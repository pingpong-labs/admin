<?php namespace Pingpong\Admin\Validation\Role;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'name' => 'required',
	        'slug' => 'required|unique:roles,slug'
	    ];
	}

}