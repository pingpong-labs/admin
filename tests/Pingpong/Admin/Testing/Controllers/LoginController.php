<?php namespace Pingpong\Admin\Testing\Controllers;

use Pingpong\Testing\TestCase;

class LoginController extends TestCase {

    public function testGetIndex()
    {
        $this->call('GET', '/admin/login');
        $this->assertResponseOk();
    }
}