<?php

use Pingpong\Admin\Menus\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\HTML;

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

if ( ! function_exists('style'))
{
    function style($url, $attributes = array(), $secure = false)
    {
        return HTML::style('packages/pingpong/admin/' . $url, $attributes, $secure);
    }
}

if ( ! function_exists('script'))
{
    function script($url, $attributes = array(), $secure = false)
    {
        return HTML::script('packages/pingpong/admin/' . $url, $attributes, $secure);
    }
}

if ( ! function_exists('aview'))
{
    function aview($view, array $data = [], array $mergeData = [])
    {
        return View::make('admin::' . $view, $data, $mergeData);
    }
}

if ( ! function_exists('menu'))
{
    function menu($name, $presenter = null)
    {
        return Menu::render($name, $presenter);
    }
}