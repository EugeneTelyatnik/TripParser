<?php

namespace App\Encoders;

use App\Collections\AbstractCollection;

interface EncoderInterface
{
    public function setData(AbstractCollection $data);

    public function encode();
}