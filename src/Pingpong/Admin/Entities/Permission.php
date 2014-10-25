<?php namespace Pingpong\Admin\Entities;

use Pingpong\Trusty\Entities\Permission as BasePermission;

class Permission extends BasePermission {

    /**
     * @var array
     */
    protected $rules = array(
        'name' => 'required',
    );

    /**
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @return array
     */
    public function getUpdateRules()
    {
        return $this->rules;
    }
}