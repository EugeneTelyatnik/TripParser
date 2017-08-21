<?php

namespace Tests\Unit;


use App\Collections\DepartureCollection;
use App\Entities\Departure;
use App\Entities\Trip;
use PHPUnit\Framework\TestCase;

class TripTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function test_can_create_trip($title, $code, $duration, $inclusions, $departures)
    {
        $trip = (new Trip())
            ->setTitle($title)
            ->setCode($code)
            ->setDuration($duration)
            ->setInclusions($inclusions)
            ->setDepartures($departures);

        $this->assertEquals($title, $trip->getTitle());
        $this->assertEquals($code, $trip->getCode());
        $this->assertEquals($duration, $trip->getDuration());
        $this->assertEquals($inclusions, $trip->getInclusions());
        $this->assertEquals($departures, $trip->getDepartures());
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_can_create_trip_via_controller($title, $code, $duration, $inclusions, $departures)
    {
        $trip = new Trip([
            'title' => $title,
            'code' => $code,
            'duration' => $duration,
            'inclusions' => $inclusions,
            'departures' => $departures
        ]);

        $this->assertEquals($title, $trip->getTitle());
        $this->assertEquals($code, $trip->getCode());
        $this->assertEquals($duration, $trip->getDuration());
        $this->assertEquals($inclusions, $trip->getInclusions());
        $this->assertEquals($departures, $trip->getDepartures());
    }

    public function dataProvider()
    {
        return [
            [
                'Anzac & Egypt Combo Tour',
                'AE-19',
                '18',
                'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels',
                new DepartureCollection(
                    new Departure(['code' => 'AN-17', 'starts' => '04/19/2015', 'price' => 1724, 'discount' => 15]),
                    new Departure(['code' => 'AN-18', 'starts' => '04/22/2015', 'price' => 1784, 'discount' => 20]),
                    new Departure(['code' => 'AN-19', 'starts' => '04/25/2015', 'price' => 1784, 'discount' => 0])
                )
            ]
        ];
    }

}