<?php

namespace App\Entities;


use App\Exceptions\InvalidArgumentException;

/**
 * Class AbstractEntity
 *
 * @package App\Entities
 */
abstract class AbstractEntity
{
    /**
     * Set field
     *
     * @param $field
     * @param $value
     * @return $this
     * @throws InvalidArgumentException
     */
    public function __set($field, $value)
    {
        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Setting the field '$field' is not valid for this entity.");
        }

        $mutator = "set" . ucfirst(strtolower($field));
        method_exists($this, $mutator) &&
        is_callable(array($this, $mutator))
            ? $this->$mutator($value) : $this->$field = $value;

        return $this;
    }

    /**
     * Get field
     *
     * @param $field
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function __get($field)
    {
        if (!property_exists($this, $field)) {
            throw new InvalidArgumentException(
                "Getting the field '$field' is not valid for this entity.");
        }

        $accessor = "get" . ucfirst(strtolower($field));
        return method_exists($this, $accessor) &&
        is_callable(array($this, $accessor))
            ? $this->$accessor() : $this->$field;
    }

    /**
     * Convert fields to array
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }

    /**
     * Validate data
     *
     * @param array $required
     * @param array $data
     * @throws InvalidArgumentException
     */
    public function validate(array $required, array $data)
    {
        foreach ($required as $param) {
            if (!isset($data[$param])) {
                throw new InvalidArgumentException('Param `' . $param . '` is required!');
            }
        }
    }
}