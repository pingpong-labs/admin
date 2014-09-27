<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Pingpong\Admin\Entities\Option;
use Illuminate\Support\Facades\HTML;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

if ( ! function_exists('pagination_links'))
{
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

function modal_popup($url, $title, $message)
{
    return View::make('admin::partials.popup', compact('url', 'title', 'message'))->render();
}

function isOnPages()
{
    return Request::is('admin/pages') || Request::is('admin/pages/*');
}

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