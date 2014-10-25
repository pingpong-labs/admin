<?php

abstract class DatabaseTestCase extends TestCase {

    public function setUp()
    {
        parent::setUp();

        $this->app['artisan']->call('admin:install');
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();

        $this->app['artisan']->call('migrate:reset');
    }

} 