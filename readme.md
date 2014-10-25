## Simple Administrator Package for Laravel 4+

[![Build Status](https://travis-ci.org/pingpong-labs/admin.svg?branch=master)](https://travis-ci.org/pingpong-labs/admin)

### Server Requirements

- PHP 5.4 or higher

### Installation

Open your composer.json file, and add the new required package.
```
	"pingpong/admin": "1.*" 
```
Next, open a terminal and run.
```
	composer update 
```

Next, Add new service provider in `app/config/app.php`.

```php
    'Pingpong\Admin\AdminServiceProvider',
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

[![Build Status](https://raw.githubusercontent.com/pingpong-labs/admin/master/shots/pingpong-admin-shot.png)](https://raw.githubusercontent.com/pingpong-labs/admin/master/shots/pingpong-admin-shot.png)

### Usage

Browse your app to the url : `http://your-host.com/admin`. By default the login credentials is `pingpong` for the username and `secret` for the password.

### Documentation

For more documentation please see [wiki](https://github.com/pingpong-labs/admin/wiki) part of this repo.

### Screencasts

https://www.dropbox.com/s/foyidbk7fzqywco/pingpong-admin-tutorial.mp4

### Todos

- Add support for all database drivers.
- Add more tests.

### License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
