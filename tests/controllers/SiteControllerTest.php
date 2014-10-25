<?php

class SiteControllerTest extends DatabaseTestCase {

	public function setUp()
	{
		parent::setUp();
		$this->app['auth']->loginUsingId(1);
	}

	public function testGetIndex()
	{
		$this->call('GET', 'admin');
		$this->assertResponseOk();	
	}

	public function testGetSettings()
	{
		$this->call('GET', 'admin/settings');
		$this->assertResponseOk();	
	}

	// TODO : added more tests

}