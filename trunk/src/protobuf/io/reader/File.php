<?php

namespace protobuf\io\reader;

/**
 * Read data from file
 */
class File extends Reader
{
    /**
     * @param string $filename
     * @return array
     */
    public function read()
    {
        $filename = func_get_arg(0);
        $string = file_get_contents($filename);
        return $this->decode($spec, $string);
    }
}