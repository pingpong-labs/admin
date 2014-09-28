<?php namespace Pingpong\Admin\Testing\Controllers;

use Pingpong\Admin\Testing\TestCase;

class LoginController extends TestCase {

    public function testGetIndex()
    {
        $this->call('GET', '/admin/login');
        $this->assertResponseOk();
    }
}