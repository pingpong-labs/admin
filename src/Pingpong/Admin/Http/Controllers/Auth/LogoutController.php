<?php namespace Pingpong\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LogoutController extends Controller {

    public function getIndex()
    {
        Auth::logout();

        return Redirect::to('admin/login');
    }

} 