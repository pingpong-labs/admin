<?php namespace Pingpong\Admin\Controllers;

session_check();

class LoginController extends BaseController {

    /**
     * Show login page.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->view('login');
    }

    /**
     * Login action.
     *
     * @return mixed
     */
    public function store()
    {
        $credentials = \Input::only('username', 'password');
        $remember = \Input::has('remember');

        if (\Auth::attempt($credentials, $remember))
        {
            $_SESSION['admin'] = \Auth::id();

            return $this->redirect('home')->withFlashMessage('Login Success!');
        }

        if (getenv('PINGPONG_ADMIN_TESTING'))
        {
            return \Redirect::to('admin/login')->withFlashMessage("Login failed!")->withFlashType('danger');
        }

        return \Redirect::back()->withFlashMessage("Login failed!")->withFlashType('danger');
    }
}