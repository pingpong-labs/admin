<?php namespace Pingpong\Admin\Validation\User;

use Pingpong\Admin\Validation\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{

    public function rules()
    {
        $id = Request::segment(3);

        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'required|min:6|max:20',
        ];
    }
}
