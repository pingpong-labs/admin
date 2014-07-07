<?php namespace Pingpong\Admin\Entities;

use Pingpong\Auth\Eloquent\Role as BaseRole;

class Role extends BaseRole
{
	protected $rules = array(
		'name'	=>  'required',
	);

	public function getRules()
	{
		return $this->rules;
	}

	public function getUpdateRules()
	{
		return $this->rules;
	}
}