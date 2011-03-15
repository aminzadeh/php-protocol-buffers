<?php

namespace protobuf\io\reader;

use protobuf\compiler\Parser;
use protobuf\Decoder;

/**
 * Abstract reader
 */
abstract class Reader
{
    /**
     * @var protobuf\Decoder
     */
    protected $decoder;

    /**
     * @var array
     */
    protected $spec = array();

    /**
     * @param Decoder $decoder
     */
    public function __construct(Decoder $decoder)
    {
        $this->decoder = $decoder;
    }

    /**
     * @param array $spec
     * @return Reader
     */
    public function setSpec(array $spec)
    {
        $this->spec = $spec;
        return $this;
    }

    /**
     * @param string $file .proto file with specification
     * @param string $string string to decode
     * @return array decoded data
     */
    protected function decode(array $spec, $string)
    {
        $data = $this->decoder->decode($spec, $string);
        return $data;
    }

    /**
     * Read data from source
     */
    abstract public function read();
}