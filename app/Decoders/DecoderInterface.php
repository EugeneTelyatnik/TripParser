<?php

namespace App\Decoders;

interface DecoderInterface
{
    public function setData($data);

    public function decode();
}