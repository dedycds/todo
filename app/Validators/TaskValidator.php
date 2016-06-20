<?php namespace App\Validators;

class TaskValidator extends Validator {

	protected $rules = array(
		'title' 	=> 'required|max:256',
		'due_date' 	=> 'required|date',
		'user_id' 	=> 'required|integer|exists:users,id',
		'priority' 	=> 'integer',
		'status'	=> 'in:started,finished'
	);
}