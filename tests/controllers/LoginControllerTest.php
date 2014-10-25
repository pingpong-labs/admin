<?php

class LoginControllerTest extends DatabaseTestCase {

	public function testGetIndex()
	{
		$this->call('GET', 'admin/login');
		$this->assertResponseOk();	
	}

	public function testPostStore()
	{
		$parameters = [
			'username' => 'pingpong',
			'password' => 'secret'
		];

		$this->call('POST', 'admin/login', $parameters);

		$this->assertRedirectedTo('admin');
	}

	public function testPostStoreWithInvalidCredentials()
	{
		$parameters = [
			'username' => 'foo',
			'password' => 'bar'
		];

		$this->call('POST', 'admin/login', $parameters);

		$this->assertRedirectedTo('admin/login');
	}

}