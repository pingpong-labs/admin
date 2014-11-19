<?php namespace Pingpong\Admin\Validation\Article;

use Pingpong\Validator\Validator;
use Illuminate\Support\Facades\Request;

class Update extends Validator {

	public function rules()
	{
		return [
	        'title' => 'required',
	        'slug' => 'required|unique:articles,slug,' . Request::segment(3),
	        'body' => 'required',
		];
	}

}