<?php namespace App\Exceptions;

use App\Validators\Validator;

class ValidationException extends \Exception
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    private $errors;

    /**
     * @param \Illuminate\Support\MessageBag|\Bedforest\Core\Validator\ValidatorService $container
     */
    public function __construct($container)
    {
        $this->errors = ($container instanceof Validator) ? $container->errors() : $container;
        parent::__construct(null);
    }

    /**
     * Get error message container
     *
     * @param boolean $asArray
     * @return \Illuminate\Support\MessageBag
     */
    public function get($asArray = false)
    {
        return ($asArray) ? $this->errors->toArray() : $this->errors;
    }


}