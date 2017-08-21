<?php

namespace App\Encoders;


use App\Collections\AbstractCollection;
use App\Collections\TripCollection;
use App\Entities\Trip;

class TripCsvEncoder implements EncoderInterface
{
    /** @var TripCollection */
    protected $data;

    /**
     * Set data
     *
     * @param $data
     * @return TripCsvEncoder
     */
    public function setData(AbstractCollection $data) : TripCsvEncoder
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Encode data to CSV
     */
    public function encode() : string
    {
        $result = $this->prepareResult($this->data);

        return $this->getCsv($result);
    }

    /**
     * Convert to CSV format
     *
     * @param $result
     * @return string
     */
    public function getCsv($result) : string {

        $csv = '';

        foreach ($result as $data) {
            $csv .= implode('|', $data) . "\n";
        }

        return $csv;
    }

    /**
     * Prepare result array for CSV
     *
     * @return array
     */
    public function prepareResult() : array
    {
        $result = [
            ['Title', 'Code', 'Duration', 'Inclusions', 'MinPrice'],
        ];

        for ($i = 0; $i < $this->data->count(); $i++) {

            /** @var Trip $trip */
            $trip = $this->data->getItem($i);

            $result[] = [
                $trip->getTitle(),
                $trip->getCode(),
                $trip->getDuration(),
                $trip->getInclusions(),
                (string) number_format($trip->getDepartures()->getMinPriceDeparture()->getTotalPrice(), 2, '.', '')
            ];
        }

        return $result;
    }

}