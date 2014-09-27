<?php namespace Pingpong\Admin\Validation\Auth;

use Pingpong\Validator\Validator;

class Register extends Validator {

    public function rules()
    {
        return [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6|max:20',
        ];
    }

}