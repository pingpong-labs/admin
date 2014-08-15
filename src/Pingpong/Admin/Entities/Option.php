<?php namespace Pingpong\Admin\Entities;

class Option extends \Eloquent
{
	protected $fillable = ['key', 'value'];

	public function scopeFindByKey($query, $key)
	{
		return $query->whereKey($key);
	}
}