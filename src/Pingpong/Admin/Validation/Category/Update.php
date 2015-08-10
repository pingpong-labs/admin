<?php

namespace Pingpong\Admin\Validation\Category;

use Pingpong\Admin\Validation\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator
{
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.Request::segment(3),
        ];
    }
}
