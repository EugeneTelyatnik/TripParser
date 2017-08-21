<?php

/** Register The Composer Auto Loader */
require __DIR__ . '/vendor/autoload.php';



// get xml by url and convert to csv
$xmlUrl = file_get_contents('https://drive.google.com/uc?export=download&id=0B5KcqJSuemo9eGxMU3JiTERUMWs');

// example of xml
$xmlText = <<<XML
<?xml version="1.0"?>
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
</TOURS>
XML;


xmlToCSV($xmlText);

/**
 * Convert xml to CSV
 *
 * @param $text
 */
function xmlToCSV($text) {

    $service = new \App\Services\TripService();
    $csv = $service
        ->setDecoder(new \App\Decoders\XmlDecoders\TripCollectionXmlDecoder())
        ->setEncoder(new \App\Encoders\TripCsvEncoder())
        ->parse($text);

    if (php_sapi_name() != 'cli') {
        $csv = nl2br($csv);
    }

    print($csv);
}