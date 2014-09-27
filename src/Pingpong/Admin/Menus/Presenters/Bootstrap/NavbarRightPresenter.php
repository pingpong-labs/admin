<?php namespace Pingpong\Admin\Menus\Presenters\Bootstrap;

class NavbarRightPresenter extends NavbarPresenter {

    public function getOpenTag()
    {
        return '<ul class="nav navbar-right top-nav">';
    }
}