<?php
namespace App\Decoders\XmlDecoders;

use App\Collections\TripCollection;
use App\Decoders\AbstractDecoder;

class TripCollectionXmlDecoder extends AbstractDecoder
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
     * Parse Trip Collection
     *
     * @return TripCollection
     */
    public function decode()
    {
        $tripCollection = new TripCollection();

        foreach ($this->data->TOUR as $trip) {
            $tripCollection->addItem((new TripXmlDecoder)->setData($trip)->decode());
        }

        return $tripCollection;
    }
}