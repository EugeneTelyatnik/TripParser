<?php

namespace App\Collections;

use App\Entities\AbstractEntity;
use App\Exceptions\InvalidArgumentException;

/**
 * Class AbstractCollection
 *
 * @package App\Collections
 */
abstract class AbstractCollection implements \IteratorAggregate
{
    /** @var $values */
    protected $values;

    /**
     * Convert to Array
     *
     * @return array
     */
    public function toArray(): array
    {

        $array = [];

        foreach ($this->values as $value) {
            if ($value instanceof AbstractEntity) {
                $array[] = $value->toArray();
            }
        }

        return $array;
    }

    /**
     * Get count of elements in collection
     *
     * @return int
     */
    public function count(): int
    {
        return count($this->values);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->values);
    }

    /**
     * Add item to collection
     *
     * @param AbstractEntity $entity
     */
    public function addItem(AbstractEntity $entity)
    {
        $this->values[] = $entity;
    }

    /**
     * Get item from collection
     *
     * @param $key
     * @return mixed
     * @throws InvalidArgumentException
     */
    public function getItem($key)
    {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        } else {
            throw new InvalidArgumentException("Invalid key $key");
        }
    }
}