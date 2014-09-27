<?php namespace Pingpong\Admin\Menus\Presenters\Bootstrap;

use Pingpong\Admin\Menus\MenuItem;

class SidebarPresenter extends NavbarPresenter {

    /**
     * @return string
     */
    public function getOpenTag()
    {
        return '<div class="collapse navbar-collapse navbar-ex1-collapse"><ul class="nav navbar-nav side-nav">';
    }

    /**
     * @return string
     */
    public function getCloseTag()
    {
        return '</ul></div>';
    }

    /**
     * @param MenuItem $item
     * @return string
     */
    public function getHeaderChildTag(MenuItem $item)
    {
        return '<li>' . PHP_EOL
        . '<a href="javascript:;" data-toggle="collapse" data-target="#item' . $item->id . '">' . PHP_EOL
        . $item->title . ' <i class="fa fa-fw fa-caret-down"></i></a>';
    }

    /**
     * @param MenuItem $item
     * @return string
     */
    public function getOpenChildTag(MenuItem $item)
    {
        return '<ul id="item' . $item->id . '" class="collapse">';
    }
} 