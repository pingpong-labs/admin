<?php namespace Pingpong\Admin;

use Exception;

class AdminException extends Exception
{
	
	protected $errors;

	function __construct($errors, $code = 0, Exception $previous = null)
	{
		$this->errors = $errors;
		parent::__construct($errors, $code, $previous);
	}

	public function getErrors()
	{
		return $this->errors;
	}
}