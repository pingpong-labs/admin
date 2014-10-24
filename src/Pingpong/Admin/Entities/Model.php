<?php namespace Pingpong\Admin\Entities;

use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Model
 * @package Pingpong\Admin\Entities
 */
class Model extends BaseModel
{
    /**
     * The validation rules.
     *
     * @var array
     */
    protected $rules = array();

    /**
     * The validation messages.
     *
     * @var array
     */
    protected $messages = array();

    /**
     * The created validation factory instance.
     *
     * @var Factory
     */
    protected $validation;

    /**
     * Get the validation messages.
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Set the validation messages.
     *
     * @param array $messages
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;
    }

    /**
     * Get the validation rules.
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set the validation rules.
     *
     * @param array $rules
     */
    public function setRules($rules)
    {
        $this->rules = $rules;
    }

    /**
     * Validate the given input.
     *
     * @param array|null $input
     * @return boolean
     */
    public function validate($input = null)
    {
        $data = $input ?: $this->getAttributes();

        $this->validation = Validator::make($data, $this->getRules(), $this->getMessages());

        return $this->validation->passes();
    }

    /**
     * Get the validation errors.
     *
     * @return mixed
     */
    public function getErrors()
    {
        return $this->validation->messages();
    }

    /**
     * Boot the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        foreach(array('creating', 'updating') as $event)
        {
            static::$event(function(BaseModel $model)
            {
                return $model->validate();
            });
        }
    }
}