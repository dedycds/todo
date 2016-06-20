<?php namespace App\Repository\Eloquent;

use App\Repository\RepositoryInterface;
use App\Entitiy\Eloquent\Entity;
use App\Validators\Validator as ValidatorService;
use App\Exceptions\ValidationException;

/**
 * Base class for repository
 */
abstract class Repository implements RepositoryInterface 
{
	/**
	 * 
	 * @var App\Entitiy\Eloquent\Entity;
	 */
	protected $entitiy;

	public function __consturct(Entity $entity)
	{
		$this->entity = $enitity;
	}

	/**
	 * find entity by id
	 * @param  mixed  $id             
	 * @param  array   $with           
	 * @param  boolean $throwException 
	 * @return Sigana\Core\Entity\EntityInterface 
	 */
	public function findById($id, array $with = array(), $throwException = true)
	{
		$model = $this->entity->find($id);

		if($model === null && $throwException){
			throw new \Exception("Data " . $this->getEntityName($this->entity) . " tidak ditemukan");
		}

		if($with)
			$model->load($with);

		return $model;
	}

	/**
	 * find all data from model
	 * @param  array   $constrains 
	 * @param  array   $with       
	 * @param  integer $limit      
	 * @return Illuminate\Database\Eloquent\Collection              
	 */
	public function all(array $constrains = array(), array $with = array(), $limit = 10)
	{
		$query = $this->entity->query();

		foreach($constrains as $key => $value){
			$query->where($key,$value);
		}

		if($with)
			$query->with($with);

		return $query->paginate($limit);
	}

	/**
	 * [create description]
	 * @param  array  $attributes 
	 * @return [type]             
	 */
	public function create(array $attributes, $validator = null)
	{
		if ($validator) {
            $operation = ValidatorService::INSERT_OPERATION;
            if (is_array($validator)) {
                $operation = $validator[1];
                $validator = $validator[0];
            }
            $this->validate($attributes, $validator, $operation);
        }

		$attributes = array_only($attributes, $this->entity->getFillable());
		$model = $this->createInstance($attributes);
		$model->save();

		return $model;
	}

	/**
	 * [update description]
	 * @param  [type] $id         
	 * @param  array  $attributes 
	 * @return [type]             
	 */
	public function update($id, array $attributes, $validator = null)
	{
		$model = $this->findById($id);

		$attributes = array_only($attributes, $this->entity->getFillable());
		$model->fill($attributes);

		if ($validator) {
            $operation = ValidatorService::UPDATE_OPERATION;
            if (is_array($validator)) {
                $operation = $validator[1];
                $validator = $validator[0];
            }
            $this->validate($model->getAttributes(), $validator, $operation);
        }
	
		$model->save();

		return $model;
	}

	/**
	 * 
	 * @param  mixed $id 
	 * @return boolean||null     
	 */
	public function delete($id)
	{
		return $this->findById($id)->delete();
	}

	/**
     * Parse entity name from full class name
     *
     * @param Entity $entity
     *
     * @return String
     */
    protected function getEntityName(Entity $entity)
    {
        $class = get_class($entity);
        return (strpos($class, '\\') !== false) ? substr($class, strrpos($class, '\\') + 1) : $class;
    }

    /**
     * Get fresh entity instance
     *
     * @param array $attributes
     *
     * @return \Bedforest\Core\Entity\EntityInterface
     */
    public function createInstance(array $attributes = array())
    {
        return $this->entity->newInstance($attributes);
    }

    /**
     * Validate attributes against provided validator operation
     *
     * @param array  $attributes
     * @param mixed  $validator
     * @param string $operation
     *
     * @throws 
     * @throws ValidationException
     */
    public function validate(array $attributes, $validator)
    {
        if (is_string($validator)) {
            $validator = \App::make($validator);
        }
        if (!$validator instanceof ValidatorService) {
            throw new SiganaException('Unable to resolve validator class');
        }
        if (!$validator->with(['input' => $attributes])->passes()) {
            throw new ValidationException($validator);
        }
    }
}