<<<<<<< HEAD
##Simple Administrator Package for Laravel 4.*

###Installation

1. Open your conposer.json file and and new required package:

  ```
  "pingpong/admin": "dev-master"
  ```

2. Open terminal and run:

  ```
  composer update
  ```

3. After composer updated, add new service provider:

  ```
  'Pingpong\Admin\AdminServiceProvider',
  ```

4. Open your terminal and run this following code:
  
  `php artisan config:publish pingpong/admin`

  `php artisan asset:publish pingpong/admin`
  
5. Done.


###Status
This package still under development.

###Example

See an example config for create `User` admin file [here](https://github.com/gravitano/admin/blob/master/example.php)
  
###License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

=======
##Simple Administrator Package for Laravel 4
>>>>>>> 25eb8f2a30a60e52caae353935a7063dc2bc05d6
