<?php namespace Pingpong\Admin\Http\Controllers;

use Illuminate\Routing\Controller;

class HomeController extends Controller {

    public function index()
    {
        return aview('index');
    }


} 