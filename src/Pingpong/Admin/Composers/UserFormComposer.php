<?php namespace Pingpong\Admin\Composers;

use Pingpong\Admin\Entities\Role;

class UserFormComposer {

    public function compose($view)
    {
        $roles = Role::lists('name', 'id');

        $view->with(compact('roles'));
    }

}