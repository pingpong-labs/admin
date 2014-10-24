<?php namespace Pingpong\Admin\Controllers;

class BaseController extends \Controller {
    
    /**
     * Show view.
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
	{
		return app('view')->make('admin::' . $view, $data, $mergeData);
	}

    /**
     * Redirect to a route.
     *
     * @param $route
     * @param array $parameters
     * @param int $status
     * @param array $headers
     * @return mixed
     */
    public function redirect($route, $parameters = array(), $status = 302, $headers = array())
	{
		return app('redirect')->route('admin.' . $route, $parameters, $status, $headers); 
	}

    /**
     * Get all input data.
     *
     * @return array
     */
    public function inputAll()
    {
        return app('request')->all();
    }
}