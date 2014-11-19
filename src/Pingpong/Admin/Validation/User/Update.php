<?php namespace Pingpong\Admin\Validation\User;

use Pingpong\Validator\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator {

	public function rules()
	{
		$id = Request::segment(3);

		return [
	        'name' => 'required',
	        'username' => 'required|unique:users,username,' . $id,
	        'email' => 'required|email|unique:users,email,' . $id,
	        'password' => 'required|min:6|max:20',
	    ];
	}

}