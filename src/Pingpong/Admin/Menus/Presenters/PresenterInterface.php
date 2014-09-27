<?php namespace Pingpong\Admin\Menus\Presenters;

use Pingpong\Admin\Menus\MenuItem;

interface PresenterInterface {

    /**
     * Get open tag.
     *
     * @return string
     */
    public function getOpenTag();

    /**
     * Get close tag.
     *
     * @return string
     */
    public function getCloseTag();

    /**
     * Get list tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getListTag(MenuItem $item);

    /**
     * Get open child tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getOpenChildTag(MenuItem $item);

    /**
     * Get close child tag.
     *
     * @return string
     */
    public function getCloseChildTag();

    /**
     * Get header child tag.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getHeaderChildTag(MenuItem $item);

    /**
     * Get footer child tag.
     *
     * @return string
     */
    public function getFooterChildTag();

    /**
     * Get divider tag.
     *
     * @return string
     */
    public function getDividerTag();

    /**
     * Get child items.
     *
     * @param MenuItem $item
     * @return string
     */
    public function getChilds(MenuItem $item);
} 