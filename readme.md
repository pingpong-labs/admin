## Simple Administrator Package for Laravel 4+

### Installation

Open your composer.json file and add a new required package.

  "pingpong/admin": "1.0.*" 

Next, open a terminal and run.

  composer update 
Next, Add new service provider in app/config/app.php.

  'Pingpong\Modules\ModulesServiceProvider',
Next, Add new class alias in app/config/php.

  'Module'        => 'Pingpong\Modules\Facades\Module',
Next, publish package configuration. Open your terminal and run:

  php artisan config:publish pingpong/modules


### Usage

### License