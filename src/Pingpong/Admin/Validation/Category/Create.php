<?php

namespace Pingpong\Admin\Validation\Category;

use Pingpong\Admin\Validation\Validator;

class Create extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
        ];
    }
}
