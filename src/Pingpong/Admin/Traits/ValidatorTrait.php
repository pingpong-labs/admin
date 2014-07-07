<?php namespace Pingpong\Admin\Traits;

use Input, Redirect, Validator;

trait ValidatorTrait
{
	protected $validator;

	public function validate(array $input = null)
	{
		$data = is_null($input) ? Input::all() : $input;

		$this->validator = Validator::make($data, $this->getRules(), $this->getMessages());

		return $this->validator->passes();
	}

	public function getRules()
	{
		return $this->rules;
	}

	public function getMessages()
	{
		return $this->messages ?: array();
	}

	public function getErrors()
	{
		return $this->validator->messages();
	}

	public function redirectFails()
	{
		return Redirect::back()
			->withInput()
			->withErrors($this->getErrors())
			->withFlashMessage("There was validation errors.")
			->withFlashType('danger')
		;
	}
}