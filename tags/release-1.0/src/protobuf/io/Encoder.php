<?php

namespace protobuf\io;

/**
 * Encode PHP array into binary string
 */
interface Encoder
{
    /**
     * @param array $spec
     * @param array $data
     * @return string
     */
    public function encode(array $spec, array $data);
}