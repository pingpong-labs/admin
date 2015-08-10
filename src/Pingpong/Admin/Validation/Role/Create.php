<?php

namespace Pingpong\Admin\Validation\Role;

use Pingpong\Admin\Validation\Validator;

class Create extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:roles,slug',
        ];
    }
}
