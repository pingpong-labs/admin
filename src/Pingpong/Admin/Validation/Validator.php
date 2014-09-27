<?php namespace Pingpong\Admin\Validation;

use Illuminate\Http\Request;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator as IlluminateValidator;
use Pingpong\Admin\Validation\Exceptions\ValidationException;

abstract class Validator {

    /**
     * @var Factory
     */
    protected $validator;

    /**
     * @var IlluminateValidator
     */
    protected $validation;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param Factory $validator
     * @param Request $request
     */
    public function __construct(Factory $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * @param IlluminateValidator $validator
     * @throws ValidationException
     */
    public function failed(IlluminateValidator $validator)
    {
        throw new ValidationException($validator->messages(), "Validation failed");
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data = null)
    {
        $data = $data ?: $this->getInput();

        $this->validation = $this->validator->make($data, $this->rules(), $this->messages());

        if ($this->validation->fails())
        {
            $this->failed($this->validation);
        }

        return true;
    }

    /**
     * @return array
     */
    public function getInput()
    {
        return $this->request->all();
    }

    /**
     * @return mixed
     */
    public function getValidation()
    {
        return $this->validation;
    }

    /**
     * @return Factory
     */
    public function getValidator()
    {
        return $this->validator;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->validation->errors();
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ( ! method_exists($this, $name))
        {
            return call_user_func_array([$this->request, $name], $arguments);
        }

        return call_user_func_array([$this, $name], $arguments);
    }

    /**
     * @param $name
     * @return string
     */
    public function __get($name)
    {
        if ( ! in_array($name, ['validator', 'request', 'validation']))
        {
            return $this->request->input($name);
        }

        return $this->{$name};
    }


}