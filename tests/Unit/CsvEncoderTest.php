<?php

namespace Tests\Unit;


use App\Collections\DepartureCollection;
use App\Collections\TripCollection;
use App\Encoders\TripCsvEncoder;
use App\Entities\Departure;
use App\Entities\Trip;
use PHPUnit\Framework\TestCase;

class CsvEncoderTest extends TestCase
{
    /** @var TripCsvEncoder */
    protected $encoder;


    public function setUp()
    {
        parent::setUp();

        $this->encoder = new TripCsvEncoder();
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_can_encode_trips(TripCollection $trips, $expectedCsv)
    {
        $encodedCsv = $this->encoder->setData($trips)->encode();

        $this->assertEquals($expectedCsv, $encodedCsv);
    }

    /**
     * @dataProvider resultDataProvider
     */
    public function test_can_prepare_result(TripCollection $trips, $expectedResult)
    {
        $encodedResult = $this->encoder->setData($trips)->prepareResult();

        $this->assertEquals($expectedResult, $encodedResult);
    }

    /**
     * @dataProvider csvDataProvider
     */
    public function test_can_encode_result_to_csv($result, $expectedCsv)
    {
        $encodedCsv = $this->encoder->getCsv($result);

        $this->assertEquals($expectedCsv, $encodedCsv);

    }

    public function csvDataProvider()
    {
        return [
            [
                [
                    ['Title', 'Code', 'Duration', 'Inclusions', 'MinPrice'],
                    ['Anzac & Egypt Combo Tour', 'AE-19', 18, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', '1427.20']
                ],
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
'
            ],
            [
                [
                    ['Title', 'Code', 'Duration', 'Inclusions', 'MinPrice'],
                    ['Anzac & Egypt Combo Tour', 'AE-19', 18, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', '1427.20'],
                    ['Turkey & Israel Combo Tour', 'AE-9', 8, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', '615.40']
                ],
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
Turkey & Israel Combo Tour|AE-9|8|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|615.40
'
            ]

        ];
    }

    public function resultDataProvider()
    {
        return [
            [
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
                ),
                [
                    ['Title', 'Code', 'Duration', 'Inclusions', 'MinPrice'],
                    ['Anzac & Egypt Combo Tour', 'AE-19', 18, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', 1427.20]
                ]

            ],
            [
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
                ),
                [
                    ['Title', 'Code', 'Duration', 'Inclusions', 'MinPrice'],
                    ['Anzac & Egypt Combo Tour', 'AE-19', 18, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', 1427.20],
                    ['Turkey & Israel Combo Tour', 'AE-9', 8, 'The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels', 615.40]
                ]
            ],
        ];
    }


    public function dataProvider()
    {
        return [
            [
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
                ),
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
'

            ],
            [
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
                ),
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
Turkey & Israel Combo Tour|AE-9|8|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|615.40
'
            ],
        ];
    }

}