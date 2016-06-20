<?php namespace App\Validators;

class LoginValidator extends Validator {

	protected $rules = array(
		'email' => 'required|email',
		'password' => 'required'

	);
}