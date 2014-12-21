<?php

abstract class AdminTestCase extends Pingpong\Testing\TestCase {

    protected function getPackageProviders()
    {
        return [
            'Pingpong\Admin\Providers\SupportServiceProvider',
        	'Pingpong\Admin\AdminServiceProvider',
        ];
    }

    /**
     * @param $app
     */
    protected function registerBootedCallback($app)
    {
        $this->setupEnvironment($app);

        $this->setupDatabase($app);

        $app['config']->set('auth.model', 'Pingpong\Admin\Entities\User');

        $app['log']->useFiles(__DIR__ . '/package.log');

        $app['router']->enableFilters();

        require __DIR__ . '/../fixture/app/routes.php';
    }

    protected function setupEnvironment($app)
    {
        putenv('PINGPONG_ADMIN_TESTING=1');

        if(gethostname() == 'gravitano-desktop')
        {
            putenv('DB_HOST=localhost');
            putenv('DB_NAME=pingpong_packages');
            putenv('DB_USERNAME=pingpong');
            putenv('DB_PASSWORD=1234');
        }
    }

    protected function setupDatabase($app)
    {
        $app['config']->set('database.default', 'sqlite');

        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('database.connections.mysql', [
            'driver'    => 'mysql',
            'host'      => getenv('DB_HOST'),
            'database'  => getenv('DB_NAME'),
            'username'  => getenv('DB_USERNAME'),
            'password'  => getenv('DB_PASSWORD'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $app['config']->set('database.connections.pgsql', [
            'driver'   => 'pgsql',
            'host'     => getenv('DB_HOST'),
            'database' => getenv('DB_NAME'),
            'username' => getenv('DB_USERNAME'),
            'password' => getenv('DB_PASSWORD'),
            'charset'  => 'utf8',
            'prefix'   => '',
            'schema'   => 'public',
        ]);
    }

    /**
     * @return array
     */
    protected function getApplicationPaths()
    {
        $basePath = realpath(__DIR__.'/../fixture');

        return [
            'app'     => "{$basePath}/app",
            'public'  => "{$basePath}/public",
            'base'    => $basePath,
            'storage' => "{$basePath}/app/storage",
        ];
    }
    
}