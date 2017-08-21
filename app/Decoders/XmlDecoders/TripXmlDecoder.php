<?php

namespace App\Decoders\XmlDecoders;

use App\Collections\DepartureCollection;
use App\Decoders\AbstractDecoder;
use App\Entities\Trip;

class TripXmlDecoder extends AbstractDecoder
{

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

    /**
     * Parse Trip
     *
     * @return Trip
     */
    public function decode(): Trip
    {
        $trip = (new Trip)
            ->setTitle($this->prepareString($this->data->Title->__toString()))
            ->setCode($this->data->Code->__toString())
            ->setDuration($this->data->Duration->__toString())
            ->setInclusions($this->prepareString($this->data->Inclusions->__toString()))
            ->setDepartures((new DepartureCollectionXmlDecoder)->setData($this->data->DEP)->decode());

        return $trip;
    }
}