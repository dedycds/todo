<?php namespace App\Entity;

use Illuminate\Contracts\Support\Arrayable;

interface EntityInterface extends Arrayable 
{

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return EntityInterface
     */
    public function fill(array $attributes);

    /**
     * Get fillable attributes of an entity
     *
     * @return array
     */
    public function getFillable();

}