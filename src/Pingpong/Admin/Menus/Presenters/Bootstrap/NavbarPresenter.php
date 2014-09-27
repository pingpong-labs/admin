<?php namespace Pingpong\Admin\Menus\Presenters\Bootstrap;

use Pingpong\Admin\Menus\MenuItem;
use Pingpong\Admin\Menus\Presenters\Presenter;

class NavbarPresenter extends Presenter {

    /**
     * Get open tag.
     *
     * @return string
     */
    public function getOpenTag()
    {
        return '<ul class="nav">';
    }

    /**
     * Get close tag.
     *
     * @return string
     */
    public function getCloseTag()
    {
        return '</ul>' . PHP_EOL;
    }

    /**
     * Get list tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getListTag(MenuItem $item)
    {
        return '<li><a href="' . url($item->url) . '">' . $item->title . '</a></li>' . PHP_EOL;
    }

    /**
     * Get open child tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getOpenChildTag(MenuItem $item)
    {
        return '<ul class="dropdown-menu">';
    }

    /**
     * Get close child tag.
     *
     * @return string
     */
    public function getCloseChildTag()
    {
        return '</ul>' . PHP_EOL;
    }

    /**
     * Get header child tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getHeaderChildTag(MenuItem $item)
    {
        return '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $item->title . ' <b class="caret"></b></a>';
    }

    /**
     * Get footer child tag.
     *
     * @return string
     */
    public function getFooterChildTag()
    {
        return '</li>';
    }

    public function getDividerTag()
    {
        return '<li class="divider"></li>';
    }
}