<?php

Route::filter('admin.auth', function()
{
	if( ! Auth::check() or ! Auth::user()->is('admin'))
	{
		Auth::logout();
		return Redirect::route('admin.login.index');
	}
});

Route::filter('admin.guest', function()
{
	if(Auth::check() && Auth::user()->is('admin')) return Redirect::route('admin.home');
});