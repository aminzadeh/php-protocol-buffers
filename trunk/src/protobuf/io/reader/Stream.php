<?php

namespace protobuf\io\reader;

/**
 * Read data from file
 */
class Stream extends Reader
{
    const LENGTH = 1000000;
    /**
     * @param resource $handle
     * @return array
     */
    public function read()
    {
        $handle = func_get_arg(0);

        $string = '';
        while (!feof($handle)) {
            $string .= stream_get_line($handle, self::LENGTH, "\n");
        }

        return $this->decode($this->spec, $string);
    }
}