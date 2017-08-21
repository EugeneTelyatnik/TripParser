<?php

namespace Tests\Unit;


use App\Collections\DepartureCollection;
use App\Collections\TripCollection;
use App\Entities\Departure;
use App\Entities\Trip;
use PHPUnit\Framework\TestCase;

class TripCollectionTest extends TestCase
{
    public function test_can_add_trip_to_collection()
    {
        $trips = new TripCollection(
            new Trip([
                'title' => 'Anzac & Egypt Combo Tour',
                'code' => 'AE-19',
                'duration' => '18',
                'inclusions' => 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels',
                'departures' => new DepartureCollection(
                    new Departure(['code' => 'AN-17', 'starts' => '04/19/2015', 'price' => 1724, 'discount' => 15]),
                    new Departure(['code' => 'AN-18', 'starts' => '04/22/2015', 'price' => 1784, 'discount' => 20]),
                    new Departure(['code' => 'AN-19', 'starts' => '04/25/2015', 'price' => 1784, 'discount' => 0])
                )
            ]),
            new Trip([
                'title' => 'Second Tour',
                'code' => 'AE-20',
                'duration' => '20',
                'inclusions' => 'Inclusions for the second tour',
                'departures' => new DepartureCollection(
                    new Departure(['code' => 'AN-27', 'starts' => '05/19/2015', 'price' => 2724, 'discount' => 15]),
                    new Departure(['code' => 'AN-28', 'starts' => '05/22/2015', 'price' => 2784, 'discount' => 25])
                )
            ]),
            new Trip([
                'title' => 'Third Tour',
                'code' => 'AE-30',
                'duration' => '10',
                'inclusions' => 'Inclusions for the third tour',
                'departures' => new DepartureCollection(
                    new Departure(['code' => 'AN-37', 'starts' => '06/19/2015', 'price' => 724, 'discount' => 15])
                )
            ])
        );

        $this->assertEquals(3, $trips->count());

        return $trips;
    }
}