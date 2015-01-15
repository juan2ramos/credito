<?php namespace hireMe\Managers;


class ValidationException extends \Exception
{

    private $errors;

    public function __construct($messages, $errors)
    {
        $this->errors = $errors;
        parent::__construct($messages);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}