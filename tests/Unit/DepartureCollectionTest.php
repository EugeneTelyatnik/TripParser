<?php

namespace Tests\Unit;


use App\Collections\DepartureCollection;
use App\Entities\Departure;
use PHPUnit\Framework\TestCase;

class DepartureCollectionTest extends TestCase
{

    public function test_can_add_departure_to_collection()
    {
        $departures = new DepartureCollection(
            new Departure(['code' => 'AN-17', 'starts' => '04/19/2015', 'price' => 1724, 'discount' => 15]),
            // MinPrice: 1465.4
            new Departure(['code' => 'AN-18', 'starts' => '04/22/2015', 'price' => 1784, 'discount' => 20]),
            // MinPrice: 1427.2
            new Departure([
                'code' => 'AN-19',
                'starts' => '04/25/2015',
                'price' => 1784,
                'discount' => 0
            ]) // MinPrice: 1784
        );

        $this->assertEquals(3, $departures->count());

        return $departures;
    }

    /**
     * @depends test_can_add_departure_to_collection
     */
    public function test_get_min_price_departure($departures)
    {
        /** @var Departure $minPriceDeparture */
        $minPriceDeparture = $departures->getMinPriceDeparture();

        $this->assertEquals(
            new Departure(['code' => 'AN-18', 'starts' => '04/22/2015', 'price' => 1784, 'discount' => 20]),
            $minPriceDeparture);
    }
}