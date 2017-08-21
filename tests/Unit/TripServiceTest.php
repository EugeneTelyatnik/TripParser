<?php

namespace Tests\Unit;


use App\Decoders\XmlDecoders\TripCollectionXmlDecoder;
use App\Encoders\TripCsvEncoder;
use App\Services\TripService;
use PHPUnit\Framework\TestCase;

class TripServiceTest extends TestCase
{

    /**
     * @dataProvider dataProvider
     */
    public function test_can_parse_trips($text, $expectedResult)
    {
        $parsedResult = (new TripService())
            ->setDecoder(new TripCollectionXmlDecoder)
            ->setEncoder(new TripCsvEncoder)
            ->parse($text);


        $this->assertEquals($parsedResult, $expectedResult);
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
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
'
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
                'Title|Code|Duration|Inclusions|MinPrice
Anzac & Egypt Combo Tour|AE-19|18|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|1427.20
Turkey & Israel Combo Tour|AE-9|8|The tour price cover the following services: Accommodation; 5, 4 and 3 star hotels|615.40
'
            ],
        ];
    }

}