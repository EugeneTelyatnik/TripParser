<?php

namespace App\Services;

class TripService extends AbstractService
{
    /**
     * Parse trips
     *
     * @param $text
     * @return mixed
     */
    public function parse($text)
    {
        $result = $this->getDecoder()->setData($text)->decode();

        return $this->getEncoder()->setData($result)->encode();
    }

}