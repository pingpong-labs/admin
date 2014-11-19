<?php namespace Pingpong\Admin\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsersController extends BaseController {

    /**
     * @var \User
     */
    protected $users;

    /**
     * @param \User $users
     */
    public function __construct()
    {
        $this->users = app(Config::get('auth.model'));
    }

    /**
     * Redirect not found.
     *
     * @return Response
     */
    protected function redirectNotFound()
    {
        return $this->redirect('users.index');
    }

    /**
     * Display a listing of users
     *
     * @return Response
     */
    public function index()
    {
        $users = $this->users->paginate(10);
        $no = $users->getFrom();

        return $this->view('users.index', compact('users', 'no'));
    }

    /**
     * Show the form for creating a new user
     *
     * @return Response
     */
    public function create()
    {
        return $this->view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return Response
     */
    public function store()
    {
        app('Pingpong\Admin\Validation\User\Create')->validate($data = $this->inputAll());

        $user = $this->users->create($data);

        $user->addRole(\Input::get('role'));

        return $this->redirect('users.index');
    }

    /**
     * Display the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        try
        {
            $user = $this->users->findOrFail($id);
            return $this->view('users.show', compact('user'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        try
        {
            $user = $this->users->findOrFail($id);

            $role = $user->getRole() ? $user->getRole()->id : null;

            return $this->view('users.edit', compact('user', 'role'));
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        try
        {   
            $data = ! \Input::has('password') ? \Input::except('password') : $this->inputAll();
            
            $user = $this->users->findOrFail($id);
                
            app('Pingpong\Admin\Validation\User\Update')->validate($data);
            
            $user->update($data);

            $user->updateRole(\Input::get('role'));

            return $this->redirect('users.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        try
        {
            $this->users->destroy($id);

            return $this->redirect('users.index');
        }
        catch (ModelNotFoundException $e)
        {
            return $this->redirectNotFound();
        }
    }

}
