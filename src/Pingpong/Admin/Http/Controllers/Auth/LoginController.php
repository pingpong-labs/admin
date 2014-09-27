<?php namespace Pingpong\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller {

    public function getIndex()
    {
        return aview('auth.login');
    }

    public function postIndex()
    {
        if (Auth::attempt(Input::only('username', 'password'), Input::has('remember')))
        {
            return app('redirect')->route('admin.home')->withSuccess('Login success');
        }

        return app('redirect')->back()->withError("Login failed");
    }

} 