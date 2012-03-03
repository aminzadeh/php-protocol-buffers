<?php

namespace protobuf\io\reader;

/**
 * Read encoded string
 */
class String extends Reader
{
    /**
     * @param string $string
     * @return object
     */
    public function read()
    {
        $string = func_get_arg(0);
        return $this->decode($this->spec, $string);
    }
}