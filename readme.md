## Simple Administrator Package for Laravel 4+

### Server Requirements

- PHP 5.4 or higher

### Installation

Open your composer.json file, and add the new required package.
```
	"pingpong/admin": "1.0.*" 
```
Next, open a terminal and run.
```
	composer update 
```

Next, Add new service provider in `app/config/app.php`.

```php
    'Pingpong\Admin\AdminServiceProvider',
    'Pingpong\Menus\MenusServiceProvider',
    'Pingpong\Trusty\TrustyServiceProvider',
```

Next, Add new aliases in `app/config/app.php`.

```php
    'Menu'				=> 'Pingpong\Menus\Facades\Menu',
    'Role'			    => 'Pingpong\Trusty\Entities\Role',
    'Permission'	    => 'Pingpong\Trusty\Entities\Permission',
    'Trusty'	    	=> 'Pingpong\Trusty\Facades\Trusty',
```

Next, update your user model to extend the `Pingpong\Admin\Entities\User` class. Looks like this.
```php
// app/model/User.php

use Pingpong\Admin\Entities\User as PingpongUser;

class User extends PingpongUser {}
```

Next, install the package.
```
php artisan admin:install
```

Done.

### Screenshot

[![Build Status](https://photos-5.dropbox.com/t/0/AAByRnUhhKoHkXeQsRIWK7WuAWSoU9tzrL8exiddZFSOVA/12/194732116/png/1024x768/3/1404982800/0/2/pingpong-admin-shot.png/T2KXwZrUInP7puy0oZloUE-x0OW45psQ_NETUcxy5x0)](https://www.dropbox.com/s/p5eaocivrb3t77h/pingpong-admin-shot.png)

### Usage

Browse your app to the url : `http://your-host.com/admin`. By default the login credentials is `pingpong` for the username and `secret` for the password.

### Documentation

For more documentation please see [wiki](https://github.com/pingpong-labs/admin/wiki) part of this repo.

### Screencasts

https://www.dropbox.com/s/foyidbk7fzqywco/pingpong-admin-tutorial.mp4

### License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
