<?php namespace Pingpong\Admin\Validation\Exceptions;

use Illuminate\Support\MessageBag;

class ValidationException extends \Exception {

    /**
     * The validation messages.
     *
     * @var MessageBag
     */
    protected $errors;

    /**
     * @param MessageBag $errors
     * @param null $messages
     * @param int $code
     * @param null $previous
     */
    public function __construct(MessageBag $errors, $messages = null, $code = 0, $previous = null)
    {
        parent::__construct($messages, $code, $previous);

        $this->errors = $errors;
    }

    /**
     * Get the validation messages.
     *
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

}