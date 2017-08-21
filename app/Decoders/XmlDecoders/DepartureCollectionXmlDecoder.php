<?php

namespace App\Decoders\XmlDecoders;


use App\Collections\DepartureCollection;
use App\Decoders\AbstractDecoder;

class DepartureCollectionXmlDecoder extends AbstractDecoder
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
     * Parse departure collection
     *
     * @return DepartureCollection
     */
    public function decode(): DepartureCollection
    {
        $departureCollection = new DepartureCollection();

        foreach ($this->data as $departure) {
            $departureCollection->addItem((new DepartureXmlDecoder)->setData($departure)->decode());
        }

        return $departureCollection;
    }
}