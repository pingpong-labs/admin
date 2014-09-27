<?php namespace Pingpong\Admin\Traits;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

trait ValidatorTrait {

    /**
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * @param array $input
     * @return mixed
     */
    public function validate(array $input = null)
    {
        $data = is_null($input) ? Input::all() : $input;

        $this->validator = Validator::make($data, $this->getRules(), $this->getMessages());

        return $this->validator->passes();
    }

    /**
     * @return mixed
     */
    public function getRules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getMessages()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->validator->messages();
    }

    /**
     * @return mixed
     */
    public function redirectFails()
    {
        return Redirect::back()
            ->withInput()
            ->withErrors($this->getErrors())
            ->withFlashMessage("There was validation errors.")
            ->withFlashType('danger');
    }
}