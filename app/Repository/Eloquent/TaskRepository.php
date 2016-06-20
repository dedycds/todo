<?php namespace App\Repository\Eloquent;

use App\Repository\TaskRepositoryInterface;
use App\Entity\Eloquent\Task;

class TaskRepository implements TaskRepositoryInterface 
{
	public function __construct(Task $entity)
	{
		parent::__construct($entity);
	}
}