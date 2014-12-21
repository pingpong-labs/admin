<?php

use Pingpong\Admin\Entities\Option;
use Pingpong\Admin\Entities\Category;

if ( ! function_exists('pagination_links'))
{
    /**
     * @param $data
     * @param null $view
     * @return mixed
     */
    function pagination_links($data, $view = null)
    {
        if ($query = Request::query())
        {
            $request = array_except($query, 'page');
            return $data->appends($request)->links($view);
        }
        return $data->links($view);
    }
}

if ( ! function_exists('modal_popup'))
{
    /**
     * @param $url
     * @param $title
     * @param $message
     * @return mixed
     */
    function modal_popup($url, $title, $message)
    {
        return View::make('admin::partials.popup', compact('url', 'title', 'message'))->render();
    }
}

if ( ! function_exists('isOnPages'))
{
    /**
     * @return bool
     */
    function isOnPages()
    {
        return Request::is('admin/pages') || Request::is('admin/pages/*');
    }
}

if ( ! function_exists('option'))
{
    /**
     * @param $key
     * @param null $default
     * @return null
     */
    function option($key, $default = null)
    {
        try
        {
            $option = Option::findByKey($key)->first();

            return ! empty($option) ? $option->value : $default;
        }
        catch (PDOException $e)
        {
            return $default;
        }
    }
}

if ( ! function_exists('style'))
{
    /**
     * @param $url
     * @param array $attributes
     * @param bool $secure
     * @return mixed
     */
    function style($url, $attributes = array(), $secure = false)
    {
        return HTML::style('packages/pingpong/admin/' . $url, $attributes, $secure);
    }
}

if ( ! function_exists('admin_asset'))
{
    /**
     * Get admin asset url.
     * 
     * @param  string  $url
     * @param  boolean $secure
     * @return string
     */
    function admin_asset($url, $secure = false)
    {
        return asset("packages/pingpong/admin/" . $url, $secure);
    }
}

if ( ! function_exists('script'))
{
    /**
     * @param $url
     * @param array $attributes
     * @param bool $secure
     * @return mixed
     */
    function script($url, $attributes = array(), $secure = false)
    {
        return HTML::script('packages/pingpong/admin/' . $url, $attributes, $secure);
    }
}

if ( ! function_exists('session_check'))
{
    /**
     * @return void
     */
    function session_check()
    {
        if ( ! getenv('PINGPONG_ADMIN_TESTING')) session_start();
    }
}

if ( ! function_exists('db_is'))
{
    /**
     * @param  string $driver
     * @return bool
     */
    function db_is($driver)
    {
        return Config::get('database.default') == $driver;
    }
}

if ( ! function_exists('user'))
{
    /**
     * Get user instance.
     * 
     * @return mixed
     */
    function user()
    {
        return app(Config::get('auth.model'));
    }
}

if( ! function_exists('article'))
{
    /**
     * Get article instance.
     * 
     * @return mixed
     */
    function article()
    {
        return new Pingpong\Admin\Entities\Article;
    }
}

if( ! function_exists('page'))
{
    /**
     * Get page instance.
     * 
     * @return mixed
     */
    function page()
    {
        return article()->onlyPage();
    }
}

if( ! function_exists('category'))
{
    /**
     * Get category instance.
     * 
     * @return mixed
     */
    function category()
    {
        return new Category;
    }
}