<?php

namespace Pingpong\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class Admin extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'admin'; }

}