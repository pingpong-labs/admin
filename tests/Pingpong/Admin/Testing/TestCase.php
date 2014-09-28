<?php namespace Pingpong\Admin\Testing;

abstract class TestCase extends \Pingpong\Testing\TestCase {

    /**
     * Get package aliases.
     *
     * @return array
     */
    protected function getPackageAliases()
    {
        return [
            'Admin' => 'Pingpong\Admin\Facades\Admin'
        ];
    }

    /**
     * Get package providers.
     *
     * @return array
     */
    protected function getPackageProviders()
    {
        return [
            'Pingpong\Admin\Providers\AdminServiceProvider',
            'Pingpong\Admin\Providers\SupportServiceProvider',
            'Pingpong\Admin\Providers\FilterServiceProvider',
            'Pingpong\Admin\Providers\ConsoleServiceProvider',
            'Pingpong\Admin\Providers\ErrorServiceProvider',
        ];
    }

    /**
     * @param $app
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }

} 