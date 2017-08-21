<?php

namespace App\Decoders\XmlDecoders;


use App\Decoders\AbstractDecoder;
use App\Entities\Departure;

class DepartureXmlDecoder extends AbstractDecoder
{
    /**
     * Parse departure
     *
     * @return Departure
     */
    public function decode(): Departure
    {
        $departure = (new Departure)
            ->setCode($this->data->attributes()->DepartureCode->__toString())
            ->setStarts($this->data->attributes()->Starts->__toString())
            ->setPrice($this->data->attributes()->EUR->__toString())
            ->setDiscount(intval($this->data->attributes()->DISCOUNT));

        return $departure;
    }

    /**
     * Implement validation for each entity
     *
     * @param $XMLElement \SimpleXMLElement
     * @return mixed
     */
    public function validate(\SimpleXMLElement $XMLElement)
    {
        // TODO: Implement validate() method.
    }
}