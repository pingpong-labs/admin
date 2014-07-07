<?php namespace Pingpong\Admin\Trusty\Facades;

use Illuminate\Support\Facades\Facade;

class Trusty extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'trusty';
	}
}