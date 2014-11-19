<?php namespace Pingpong\Admin\Validation\User;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'name' => 'required',
	        'email' => 'required|email|unique:users,email',
	        'username' => 'required|unique:users,username',
	        'password' => 'required|min:6|max:20',
	    ];
	}

}