<?php

namespace protobuf\compiler;

/**
 * Parse .proto file into PHP array
 */
interface Parser
{
    /**
     * @param string $file
     * @return array
     */
    public function parse($file);
}