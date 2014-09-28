<?php

use Pingpong\Admin\Menus\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\ViewErrorBag;

if ( ! function_exists('option'))
{
    /**
     * Get option from database.
     *
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
     * Generate stylesheet tag from admin's package.
     *
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

if ( ! function_exists('script'))
{
    /**
     * Generate script tag from admin's package.
     *
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

if ( ! function_exists('aview'))
{
    /**
     * Return a view from admin's package.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return mixed
     */
    function aview($view, array $data = [], array $mergeData = [])
    {
        return View::make('admin::' . $view, $data, $mergeData);
    }
}

if ( ! function_exists('menu'))
{
    /**
     * Render menu.
     *
     * @param $name
     * @param null $presenter
     * @return null|string
     */
    function menu($name, $presenter = null)
    {
        return Menu::render($name, $presenter);
    }
}

if ( ! function_exists('r'))
{
    /**
     * Generate a url from the registered route.
     *
     * @param $route
     * @param array $parameters
     * @param string $prefix
     * @return string
     */
    function r($route, $parameters = array(), $prefix = 'admin')
    {
        return route("{$prefix}.{$route}", $parameters);
    }
}

if ( ! function_exists('error_for'))
{
    /**
     * Get error message for the specified field and format it to "text-danger" style.
     *
     * @param $field
     * @param ViewErrorBag $errors
     * @return mixed
     */
    function error_for($field, ViewErrorBag $errors)
    {
        return $errors->first($field, '<div class="text-danger">:message</div>');
    }
}