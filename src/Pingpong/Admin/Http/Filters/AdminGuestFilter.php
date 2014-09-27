<?php namespace Pingpong\Admin\Http\Filters;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminGuestFilter {

    public function filter()
    {
        if(Auth::check())
        {
            return Redirect::to('admin');
        }

    }
    
} 