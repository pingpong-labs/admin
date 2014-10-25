<?php

class TestCase extends Pingpong\Testing\TestCase {

    protected function getPackageProviders()
    {
        return [
        	'Pingpong\Admin\AdminServiceProvider',
        ];
    }

    /**
     * @param $app
     */
    protected function registerBootedCallback($app)
    {
        putenv('TESTING=1');

        $options = array(
            'driver'    => 'mysql',
            'host'      => getenv('DB_HOST') ?: 'localhost',
            'database'  => getenv('DB_NAME') ?: 'pingpong_packages',
            'username'  => getenv('DB_USERNAME') ?: 'pingpong',
            'password'  => getenv('DB_PASSWORD') ?: '1234',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        );

        $app['config']->set('database.connections.mysql', $options);

        $app['config']->set('auth.model', 'Pingpong\Admin\Entities\User');

        ini_set('display_errors', '0');     # don't show any errors...
        
        error_reporting(E_ALL | E_STRICT);  # ...but do log them
    }
    
}