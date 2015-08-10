<?php

namespace Pingpong\Admin\Validation\Permission;

use Pingpong\Admin\Validation\Validator;

class Create extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:permissions,slug',
        ];
    }
}
