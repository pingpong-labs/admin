<?php namespace Pingpong\Admin\Entities;

class Category extends \Eloquent
{
	protected $fillable = ['name', 'slug', 'description'];

	protected $rules = [
		'name'	=>	'required',
		'slug'	=>	'required',
		'description'	=>	'required',
	];

	public function articles()
	{
		return $this->hasMany('Article');
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