<?php namespace Pingpong\Admin\Validation\Article;

use Pingpong\Validator\Validator;

class Create extends Validator {

	public function rules()
	{
		return [
	        'title' => 'required',
	        'slug' => 'required|unique:articles,slug',
	        'body' => 'required',
	        'image' => 'required|image',
		];
	}

}