<?php

namespace App\Collections;

use App\Entities\Departure;

/**
 * Class DepartureCollection
 * @package App\Collections
 */
class DepartureCollection extends AbstractCollection
{
    /**
     * DepartureCollection constructor.
     *
     * @param Departure[] ...$departures
     */
    public function __construct(Departure ...$departures)
    {
        $this->values = $departures;
    }

    /**
     * Get departure with minimal price
     *
     * @return Departure
     */
    public function getMinPriceDeparture(): Departure
    {
        /** @var Departure $minPriceDeparture */
        $minPriceDeparture = null;

        foreach ($this->values as $departure) {

            if (is_null($minPriceDeparture)) {
                $minPriceDeparture = $departure;
                continue;
            }

            if ($departure->getTotalPrice() < $minPriceDeparture->getTotalPrice()) {
                $minPriceDeparture = $departure;
            }
        }

        return $minPriceDeparture;

    }

}