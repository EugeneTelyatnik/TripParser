<?php

namespace App\Decoders;

/**
 * Class AbstractDecoder
 * @package App\Decoders
 */
abstract class AbstractDecoder implements DecoderInterface
{
    /** @var \SimpleXMLElement */
    protected $data;

    /**
     * Set Data
     *
     * @param $data
     * @return DecoderInterface
     */
    public function setData($data): DecoderInterface
    {
        if ($data instanceof \SimpleXMLElement) {
            $this->data = $data;
        } else {
            $this->data = new \SimpleXMLElement($data, LIBXML_NOCDATA);
        }

        $this->validate($this->data);

        return $this;
    }

    /**
     * Implement validation for each entity
     *
     * @param $XMLElement \SimpleXMLElement
     * @return mixed
     */
    abstract public function validate(\SimpleXMLElement $XMLElement);

    /**
     * Remove symbols and tags from string
     *
     * @param string $string
     * @return string
     */
    protected function prepareString(string $string): string
    {
        $string = str_replace('&nbsp;', ' ', $string);
        $string = trim(html_entity_decode(strip_tags($string)));
        $string = preg_replace('/\s+/', ' ', $string);

        return $string;
    }
}