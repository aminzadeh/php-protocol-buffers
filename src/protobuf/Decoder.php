<?php

namespace protobuf;

/**
 * Decode binary string into PHP array
 */
interface Decoder
{
    /**
     * @param array $spec
     * @param string $string
     * @return array
     */
    public function decode(array $spec, $string);
}