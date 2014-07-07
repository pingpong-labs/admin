<?php namespace Pingpong\Admin\Entities;

use Pingpong\Trusty\Entities\Permission as BasePermission;

class Permission extends BasePermission
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