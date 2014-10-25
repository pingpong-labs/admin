<?php namespace Pingpong\Admin\Filters;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthFilter extends Filter {

    /**
     * @return mixed
     */
    public function filter()
    {
        if ( ! Auth::check() or ! Auth::user()->is('admin'))
        {
            Auth::logout();

            return Redirect::route('admin.login.index');
        }
    }

} 