<?php

namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Input;
use Pingpong\Admin\Entities\Permission;
use Pingpong\Admin\Repositories\Permissions\PermissionRepository;
use Pingpong\Admin\Validation\Permission\Create;
use Pingpong\Admin\Validation\Permission\Update;

class PermissionsController extends BaseController
{
    protected $repository;

    public function __construct(PermissionRepository $repository)
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
        return $this->redirect('permissions.index');
    }

    /**
     * Display a listing of permissions.
     *
     * @return Response
     */
    public function index()
    {
        $permissions = $this->repository->allOrSearch(Input::get('q'));

        $no = $permissions->firstItem();

        return $this->view('permissions.index', compact('permissions', 'no'));
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @return Response
     */
    public function store(Create $request)
    {
        $data = $request->all();

        $this->repository->create($data);

        return $this->redirect('permissions.index');
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return $this->view('permissions.show', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            $permission = $this->repository->findById($id);

            return $this->view('permissions.edit', compact('permission'));
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified permission in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(Update $request, $id)
    {
        try {
            $permission = $this->repository->findById($id);

            $data = $request->all();

            $permission->update($data);

            return $this->redirect('permissions.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified permission from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);

            return $this->redirect('permissions.index');
        } catch (ModelNotFoundException $e) {
            return $this->redirectNotFound();
        }
    }
}
