<?php

namespace Tests\Unit;

use App\Collections\DepartureCollection;
use App\Collections\TripCollection;
use App\Decoders\XmlDecoders\DepartureCollectionXmlDecoder;
use App\Decoders\XmlDecoders\DepartureXmlDecoder;
use App\Decoders\XmlDecoders\TripCollectionXmlDecoder;
use App\Decoders\XmlDecoders\TripXmlDecoder;
use App\Entities\Departure;
use App\Entities\Trip;
use PHPUnit\Framework\TestCase;

class XmlDecoderTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function test_can_decode_trip_collection($string, TripCollection $expectedTrips)
    {
        $xmlElement = new \SimpleXMLElement($string, LIBXML_NOCDATA);

        $decoder = new TripCollectionXmlDecoder();

        $parsedTrips = $decoder->setData($xmlElement)->decode();

        $this->assertEquals($expectedTrips, $parsedTrips);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_can_decode_trip($string, TripCollection $expectedTrips)
    {
        $xmlElement = new \SimpleXMLElement($string, LIBXML_NOCDATA);

        $decoder = new TripXmlDecoder();

        $parsedTrip = $decoder->setData($xmlElement->TOUR[0])->decode();

        $expectedTrip = $expectedTrips->getItem(0);

        $this->assertEquals($expectedTrip, $parsedTrip);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_can_decode_departure_collection($string, TripCollection $expectedTrips)
    {
        $xmlElement = new \SimpleXMLElement($string, LIBXML_NOCDATA);

        $expectedDepartures = $expectedTrips->getItem(0)->departures;

        $decoder = new DepartureCollectionXmlDecoder();
        $parsedDepartures = $decoder->setData($xmlElement->TOUR[0]->DEP)->decode();

        $this->assertEquals($expectedDepartures, $parsedDepartures);
    }

    public function test_can_decode_departure()
    {
        $xmlElement = new \SimpleXMLElement('<?xml version="1.0"?><DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />',
            LIBXML_NOCDATA);

        $expectedDeparture = new Departure([
            'code' => 'AN-17',
            'starts' => '04/19/2015',
            'price' => 1724,
            'discount' => 15
        ]);

        $decoder = new DepartureXmlDecoder();
        $parsedDeparture = $decoder->setData($xmlElement)->decode();

        $this->assertEquals($expectedDeparture, $parsedDeparture);
    }


    public function dataProvider()
    {
        return [
            [
                '<?xml version="1.0"?>
                <TOURS>
                    <TOUR>
                        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
                        <Code>AE-19</Code>
                        <Duration>18</Duration>
                        <Start>Istanbul</Start>
                        <End>Cairo</End>
                        <Inclusions>
                            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
                        </Inclusions>
                        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
                        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
                        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
                    </TOUR>
                </TOURS>',

                new TripCollection(
                    new Trip([
                        'title' => 'Anzac & Egypt Combo Tour',
                        'code' => 'AE-19',
                        'duration' => '18',
                        'inclusions' => 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels',
                        'departures' => new DepartureCollection(
                            new Departure([
                                'code' => 'AN-17',
                                'starts' => '04/19/2015',
                                'price' => 1724,
                                'discount' => 15
                            ]),
                            new Departure([
                                'code' => 'AN-18',
                                'starts' => '04/22/2015',
                                'price' => 1784,
                                'discount' => 20
                            ]),
                            new Departure([
                                'code' => 'AN-19',
                                'starts' => '04/25/2015',
                                'price' => 1784,
                                'discount' => 0
                            ])
                        )
                    ])
                )
            ],
            [
                '<?xml version="1.0"?>
                <TOURS>
                    <TOUR>
                        <Title><![CDATA[Anzac &amp; Egypt Combo Tour]]></Title>
                        <Code>AE-19</Code>
                        <Duration>18</Duration>
                        <Start>Istanbul</Start>
                        <End>Cairo</End>
                        <Inclusions>
                            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
                        </Inclusions>
                        <DEP DepartureCode="AN-17" Starts="04/19/2015" GBP="1458" EUR="1724" USD="2350" DISCOUNT="15%" />
                        <DEP DepartureCode="AN-18" Starts="04/22/2015" GBP="1558" EUR="1784" USD="2550" DISCOUNT="20%" />
                        <DEP DepartureCode="AN-19" Starts="04/25/2015" GBP="1558" EUR="1784" USD="2550" />
                    </TOUR>
                    <TOUR>
                        <Title><![CDATA[Turkey &amp; Israel Combo Tour ]]></Title>
                        <Code>AE-9</Code>
                        <Duration>8</Duration>
                        <Start>Ankara</Start>
                        <End>Tel Aviv</End>
                        <Inclusions>
                            <![CDATA[<div style="margin: 1px 0px; padding: 1px 0px; border: 0px; outline: 0px; font-size: 14px; vertical-align: baseline; text-align: justify; line-height: 19px; color: rgb(6, 119, 179);">The tour price&nbsp; cover the following services: <b style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; background-color: transparent;">Accommodation</b>; 5, 4&nbsp;and&nbsp;3 star hotels&nbsp;&nbsp;</div>]]>
                        </Inclusions>
                        <DEP DepartureCode="AN-7" Starts="05/19/2015" GBP="458" EUR="724" USD="350" DISCOUNT="15%" />
                        <DEP DepartureCode="AN-9" Starts="05/25/2015" GBP="558" EUR="784" USD="550" />
                    </TOUR>
                </TOURS>',

                new TripCollection(
                    new Trip([
                        'title' => 'Anzac & Egypt Combo Tour',
                        'code' => 'AE-19',
                        'duration' => '18',
                        'inclusions' => 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels',
                        'departures' => new DepartureCollection(
                            new Departure([
                                'code' => 'AN-17',
                                'starts' => '04/19/2015',
                                'price' => 1724,
                                'discount' => 15
                            ]),
                            new Departure([
                                'code' => 'AN-18',
                                'starts' => '04/22/2015',
                                'price' => 1784,
                                'discount' => 20
                            ]),
                            new Departure([
                                'code' => 'AN-19',
                                'starts' => '04/25/2015',
                                'price' => 1784,
                                'discount' => 0
                            ])
                        )
                    ]),
                    new Trip([
                        'title' => 'Turkey & Israel Combo Tour',
                        'code' => 'AE-9',
                        'duration' => '8',
                        'inclusions' => 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels',
                        'departures' => new DepartureCollection(
                            new Departure([
                                'code' => 'AN-7',
                                'starts' => '05/19/2015',
                                'price' => 724,
                                'discount' => 15
                            ]),
                            new Departure([
                                'code' => 'AN-9',
                                'starts' => '05/25/2015',
                                'price' => 784,
                                'discount' => 0
                            ])
                        )
                    ])
                )
            ],
        ];
    }

}