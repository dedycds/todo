<?php namespace App\Entity\Eloquent;

use App\Entity\TaskInterface;

class Task extends Entity implements TaskInterface
{
	protected $table = 'tasks';

	protected $fillable = [
		'due_date',
		'title',
		'description',
		'priority',
		'user_id',
		'status'
	];

	/**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
	public function owner()
    {
        return $this->belongsTo(__NAMESPACE__.'\\User');
    }
}