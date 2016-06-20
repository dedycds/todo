<?php namespace App\Validators;

use Illuminate\Validation\Factory;

abstract class BaseValidator {

	/**
	 * Validator
	 * @var object
	 */
	protected $validator;

	/**
	 * Data to be validated
	 * @var array
	 */
	protected $data = array();

	/**
	 * Validations rules
	 * @var array
	 */
	protected $rules = array();

	/**
	 * Validation errors
	 * @var array
	 */
	protected $errors = array();

	public function __construct(Factory $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Set data to be validated
	 * @param  array  $data 
	 * @return self       
	 */
	public function with(array $data = array())
	{
		$this->data = $data;

		return $this;
	}

	/**
	 * Get validation errors
	 * @return array 
	 */
	public function errors()	
	{
		return $this->errors;
	}

	public function passes()
	{
		$validator = $this->validator->make($this->data, $this->rules);
 
	    if( $validator->fails() )
	    {
	      $this->errors = $validator->messages();
	      return false;
	    }
	 
	    return true;
	}





}