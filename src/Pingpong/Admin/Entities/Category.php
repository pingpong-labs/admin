<?php namespace Pingpong\Admin\Entities;

use Pingpong\Validation\ModelValidator;

class Category extends ModelValidator
{
	protected $fillable = ['name', 'slug', 'description'];

	protected $rules = [
		'name'	=>	'required',
		'slug'	=>	'required|unique:categories,slug',
		'description'	=>	'required',
	];

	public function articles()
	{
		return $this->hasMany(__NAMESPACE__ . '\\Article');
	}

	public function scopeOptions($query)
	{
		return $query->lists('name', 'id');
	}

	// validation
	public function getRules()
	{
		return $this->rules;
	}

	public function getUpdateRules()
	{
		return $this->rules;
	}
}