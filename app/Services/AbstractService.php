<?php

namespace App\Services;

use App\Decoders\DecoderInterface;
use App\Encoders\EncoderInterface;
use App\Exceptions\RuntimeException;

abstract class AbstractService
{

    /** @var $encoder */
    protected $encoder;

    /** @var $decoder */
    protected $decoder;

    /**
     * Set encoder
     *
     * @param EncoderInterface $encoder
     * @return $this
     */
    public function setEncoder(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        return $this;
    }

    /**
     * Get encoder
     *
     * @return EncoderInterface|null
     * @throws RuntimeException
     */
    public function getEncoder()
    {
        if ($this->encoder === null) {
            throw new RuntimeException(
                "There is not an encoder to use.");
        }
        return $this->encoder;
    }

    /**
     * Set decoder
     *
     * @param DecoderInterface $decoder
     * @return $this
     */
    public function setDecoder(DecoderInterface $decoder)
    {
        $this->decoder = $decoder;
        return $this;
    }


    /**
     * Get decoder
     *
     * @return DecoderInterface|null
     * @throws RuntimeException
     */
    public function getDecoder()
    {
        if ($this->decoder === null) {
            throw new RuntimeException(
                "There is not a decoder to use.");
        }
        return $this->decoder;
    }
}