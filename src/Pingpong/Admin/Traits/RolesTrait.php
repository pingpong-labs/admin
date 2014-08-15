<?php namespace Pingpong\Admin\Traits;

trait RolesTrait
{
	/**
	 * Relation to "Role".
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|null
	 */
	public function roles()
	{
		return $this->belongsToMany('Pingpong\Auth\Eloquent\Role')->withTimestamps();
	}

	/**
	 * Get all roles from current user.
	 *
	 * @return array|null
	 */
	public function getRoles()
	{
		return ! is_null($this->roles) ? $this->roles->lists('slug') : null;
	}

	/**
	 * Get all roles from current user.
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|null
	 */
	public function getPermissions()
	{
		return ! is_null($this->getRole()) ? $this->getRole()->permissions : null;
	}

	/**
	 * Get user role from the current user.
	 *
	 * @return \Role
	 */
	public function getRole()
	{
		return $this->roles->first();
	}

	public function getRoleId()
	{
		return $this->getRole() ? $this->getRole()->id : null;
	}

	/**
	 * Get all permissions from the current user.
	 *
	 * @return array|null
	 */
	public function permissions()
	{
		return ! is_null($this->getPermissions()) ? $this->getPermissions()->lists('slug') : null;
	}

	/**
	 * Check whether the user has a given role.
	 *
	 * @param  string  $role  
	 * @return boolean
	 */
	public function is($role)
	{
		return in_array($role, $this->getRoles());
	}

	/**
	 * Check whether the user has a given permission.
	 *
	 * @param  string  $permission  
	 * @return boolean
	 */
	public function can($permission)
	{
		return in_array($permission, $this->permissions());
	}

	/**
	 * Has role scope.
	 * 
	 * @param  Builder $query 
	 * @param  string  $type  
	 * @return Builder        
	 */
	public function scopeHasRole($query, $type)
	{
		return $query->whereHas('roles', function($query) use ($type)
		{
			$query->where('slug', $type);
		});
	}

	/**
	 * Add role to this user.
	 * 
	 * @param int $id 
	 */
	public function addRole($id)
	{
		$this->roles()->attach($id);
	}

	public function updateRole($id)
	{
		$this->roles()->detach($this->getRoleId());

		$this->addRole($id);
	}

	/**
	 * Determine whether this user is an administrator.
	 * 
	 * @return boolean
	 */
	public function isAdmin()
	{
		return $this->is('admin');
	}
}