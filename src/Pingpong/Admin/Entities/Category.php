<?php namespace Pingpong\Admin\Entities;

class Category extends Model
{
	protected $fillable = ['name', 'slug', 'description'];

	protected $rules = [
		'name'	=>	'required',
		'slug'	=>	'required|unique:categories,slug',
	];

	public function articles()
	{
		return $this->hasMany(__NAMESPACE__ . '\\Article');
	}

	public function scopeOptions($query)
	{
		return $query->lists('name', 'id');
	}
}