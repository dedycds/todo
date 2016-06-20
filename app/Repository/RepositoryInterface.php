<?php namespace App\Repository;

interface RepositoryInterface 
{
	/**
	 * find entity by id
	 * @param  mixed  $id             
	 * @param  array   $with           
	 * @param  boolean $throwException 
	 * @return Sigana\Core\Entity\EntityInterface 
	 */
	public function findById($id, array $with = array(), $throwException = true);

	/**
	 * find all data from model
	 * @param  array   $constrains 
	 * @param  array   $with       
	 * @param  integer $limit      
	 * @return Illuminate\Database\Eloquent\Collection              
	 */
	public function all(array $constrains = array(), array $with = array(), $limit = 10);

	/**
	 * [create description]
	 * @param  array  $attributes 
	 * @return [type]             
	 */
	public function create(array $attributes, $validator = null);

	/**
	 * [update description]
	 * @param  [type] $id         
	 * @param  array  $attributes 
	 * @return [type]             
	 */
	public function update($id, array $attributes, $validator = null);

	/**
	 * 
	 * @param  mixed $id 
	 * @return boolean||null     
	 */
	public function delete($id);


    /**
     * Get fresh entity instance
     *
     * @param array $attributes
     *
     * @return \Bedforest\Core\Entity\EntityInterface
     */
    public function createInstance(array $attributes = array());

    /**
     * Validate attributes against provided validator operation
     *
     * @param array  $attributes
     * @param mixed  $validator
     * @param string $operation
     *
     * @throws ZorException
     * @throws ValidationException
     */
    public function validate(array $attributes, $validator);
}