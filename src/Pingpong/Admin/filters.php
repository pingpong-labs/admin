<?php

use Pingpong\Admin\Filters\AuthFilter;
use Pingpong\Admin\Filters\GuestFilter;

Route::filter('admin.auth', AuthFilter::className());

Route::filter('admin.guest', GuestFilter::className());