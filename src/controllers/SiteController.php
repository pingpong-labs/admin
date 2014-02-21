<?php

namespace Pingpong\Admin;

use Config, View;

class SiteController extends \Controller
{
	public function index()
	{
		$view = Config::get('admin::admin.homepage')['view'];
		$data = Config::get('admin::admin.homepage')['data'];
		return View::make($view, $data);
	}
}