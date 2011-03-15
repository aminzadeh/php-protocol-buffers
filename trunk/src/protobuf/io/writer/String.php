<?php

namespace protobuf\io\writer;

/**
 * Encode object into binary string
 */
class String extends Writer
{
    /**
     * @param string $spec
     * @param array $data
     * @return string
     */
    public function write($spec, array $data)
    {
        return $this->encode($spec, $data);
    }
}