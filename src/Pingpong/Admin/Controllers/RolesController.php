<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Pingpong\Admin\Entities\Role;

class RolesController extends BaseController {

    /**
     * @var \Pingpong\Admin\Entities\Role
     */
    protected $roles;

    /**
     * @param \Pingpong\Admin\Entities\Role $roles
     */
    public function __construct(Role $roles)
    {
        $this->roles = $roles;
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect('roles.index');
    }

    /**
     * Display a listing of roles
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->roles->paginate(10);
        $no = $roles->getFrom();

        return $this->view('roles.index', compact('roles', 'no'));
    }

    /**
     * Show the form for creating a new role
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @return Response
     */
    public function store()
    {   
        app('Pingpong\Admin\Validation\Role\Create')->validate($data = $this->inputAll());

        $this->roles->create($data);

        return $this->redirect('roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $role = $this->roles->findOrFail($id);
            return $this->view('roles.show', compact('role'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            $role = $this->roles->findOrFail($id);

            $permission_role = $role->permissions->lists('id');

            return $this->view('roles.edit', compact('role', 'permission_role'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try
        {
            $role = $this->roles->findOrFail($id);
            
            app('Pingpong\Admin\Validation\Role\Update')->validate($data = $this->inputAll());

            $role->update($data);

            if($role->permissions->count())
            {
                $role->permissions()->detach($role->permissions->lists('id'));

                $role->permissions()->attach(\Input::get('permissions'));
            }

            if( $role->permissions->count() == 0 && count(\Input::get('permissions')) > 0 ) {
                $role->permissions()->attach(\Input::get('permissions'));
            }

            return $this->redirect('roles.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $this->roles->destroy($id);

            return $this->redirect('roles.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

}
