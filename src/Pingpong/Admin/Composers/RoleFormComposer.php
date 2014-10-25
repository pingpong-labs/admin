<?php namespace Pingpong\Admin\Composers;

use Pingpong\Admin\Entities\Permission;

class RoleFormComposer {

    public function compose($view)
    {
        $permissions = Permission::lists('name', 'id');

        $view->with(compact('permissions'));
    }

}