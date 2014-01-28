<?php

namespace Pingpong\Admin;

use HTML, Config;
use Closure;

class Admin
{
	public function style($url, $attributes = array())
	{
		return HTML::style('packages/pingpong/admin/'. $url, $attributes);
	}

	public function script($url, $attributes = array())
	{
		return HTML::script('packages/pingpong/admin/'. $url, $attributes);
	}

	public function copyright()
	{
		$callback = Config::get('admin::admin.copyright');
		if(is_string($callback))
		{
			return $callback;
		}elseif($callback instanceof Closure)
		{
			return call_user_func($callback);
		}else{
			return 'Copyright must be a string or closure.';
		}
	}	

	public function getConfig($resource, $key = null)
	{
		return Config::get("resources::$resource.".$key);
	}
}