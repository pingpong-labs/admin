<?php namespace Pingpong\Admin\Validation\Auth;

use Pingpong\Validator\Validator;

class Login extends Validator {

    /**
     * The validation rules.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

}