<?php

namespace App\Collections;

use App\Entities\Trip;

/**
 * Class TripCollection
 * @package App\Collections
 */
class TripCollection extends AbstractCollection
{

    /**
     * TripCollection constructor.
     *
     * @param Trip[] ...$trips
     */
    public function __construct(Trip ...$trips)
    {
        $this->values = $trips;
    }

}