<?php namespace Pingpong\Admin\Controllers;

session_start();

class LoginController extends BaseController
{
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
		$remember    = \Input::has('remember');
       	
       	if(\Auth::attempt($credentials, $remember))
       	{
       		$_SESSION['admin'] = \Auth::id();
       		
       		return $this->redirect('home')->withFlashMessage('Login Success!');
       	} 

        return app('redirect')->back()->withFlashMessage("Login failed!")->withFlashType('danger');
	}
}