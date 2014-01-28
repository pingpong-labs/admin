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
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38
	}	

	public function getConfig($resource, $key = null)
	{
		return Config::get("resources::$resource.".$key);
<<<<<<< HEAD
=======
=======
>>>>>>> 9915882e3f7d6642bffcb31c5bd1de414fd4d3dc
>>>>>>> 53a5123897370f9f62a4a5fefa48de54ea763d38
	}
}