<?php

namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Entities\Role;
use Pingpong\Admin\Repositories\Roles\RoleRepository;
use Pingpong\Admin\Validation\Role\Create;
use Pingpong\Admin\Validation\Role\Update;

class RolesController extends BaseController
{
    protected $repository;

    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
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
     * Display a listing of roles.
     *
     * @return Response
     */
    public function index()
    {
        $roles = $this->repository->allOrSearch(Input::get('q'));

        $no = $roles->firstItem();

        return $this->view('roles.index', compact('roles', 'no'));
    }

    /**
     * Show the form for creating a new role.
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
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return $this->redirect('roles.index');
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $role = $this->repository->findById($id);

            return $this->view('roles.show', compact('role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $role = $this->repository->findById($id);

            $permission_role = $role->permissions->lists('id');

            return $this->view('roles.edit', compact('role', 'permission_role'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified role in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $role = $this->repository->findById($id);

            $data = $request->all();

            $role->update($data);

            if ($role->permissions->count()) {
                $role->permissions()->detach($role->permissions->lists('id')->toArray());

                $role->permissions()->attach(\Input::get('permissions'));
            }

            if ($role->permissions->count() == 0 && count(\Input::get('permissions')) > 0) {
                $role->permissions()->attach(\Input::get('permissions'));
            }

            return $this->redirect('roles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified role from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect('roles.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
