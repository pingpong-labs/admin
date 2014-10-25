<?php namespace Pingpong\Admin\Filters;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GuestFilter extends Filter {

    /**
     * @return mixed
     */
    public function filter()
    {
        if (Auth::check() && Auth::user()->is('admin')) return Redirect::route('admin.home');
    }

} 