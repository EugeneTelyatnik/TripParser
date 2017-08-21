<?php

namespace Tests\Unit;


use App\Entities\Departure;
use PHPUnit\Framework\TestCase;

class DepartureTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test_can_set_departure($code, $starts, $price, $discount): Departure
    {
        $departure = (new Departure)
            ->setCode($code)
            ->setStarts($starts)
            ->setPrice($price)
            ->setDiscount($discount);

        $this->assertEquals($code, $departure->getCode());
        $this->assertEquals($starts, $departure->getStarts()->format('m/d/Y'));
        $this->assertEquals($price, $departure->getPrice());
        $this->assertEquals($discount, $departure->getDiscount());

        return $departure;
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_can_set_departure_in_constructor($code, $starts, $price, $discount)
    {
        $departure = new Departure(['code' => $code, 'starts' => $starts, 'price' => $price, 'discount' => $discount]);

        $this->assertEquals($code, $departure->getCode());
        $this->assertEquals($starts, $departure->getStarts()->format('m/d/Y'));
        $this->assertEquals($price, $departure->getPrice());
        $this->assertEquals($discount, $departure->getDiscount());
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_calculate_total_price_for_departure($code, $starts, $price, $discount, $totalPrice)
    {
        $departure = new Departure(['code' => $code, 'starts' => $starts, 'price' => $price, 'discount' => $discount]);

        $this->assertEquals($totalPrice, $departure->getTotalPrice());
    }


    public function dataProvider()
    {
        return [
            ['AN-17', '04/19/2015', 1724, 15, 1465.40],
            ['AN-18', '04/22/2015', 1784, 20, 1427.20],
            ['AN-19', '04/25/2015', 1784, 0, 1784.00],
        ];
    }

}