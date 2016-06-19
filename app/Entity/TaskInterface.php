<?php App\Entity; 

interface TaskInterface extends EntityInterface
{
	const STATUS_STARTED = 'started';

	const STATUS_FINISHED = 'finished';
}

