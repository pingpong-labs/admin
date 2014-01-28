<?php

$filters = Config::get('admin::admin.filters');

foreach ($filters as $name => $callback) {
	
	Route::filter($name, $callback);

}
