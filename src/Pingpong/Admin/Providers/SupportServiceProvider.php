<?php namespace Pingpong\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class SupportServiceProvider extends ServiceProvider {

	public function boot()
	{
        require __DIR__ . '/../permissions.php';
        require __DIR__ . '/../filters.php';
        require __DIR__ . '/../composers.php';
        require __DIR__ . '/../helpers.php';
        require __DIR__ . '/../observers.php';
        require __DIR__ . '/../routes.php';
	}

	public function register()
	{
		//	
	}

}