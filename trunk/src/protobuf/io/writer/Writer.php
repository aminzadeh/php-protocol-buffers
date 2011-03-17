<?php

namespace protobuf\io\writer;

use protobuf\Encoder;

/**
 * Abstract writer
 */
abstract class Writer
{
    /**
     * @var protobuf\Encoder
     */
    protected $encoder;

    /**
     * @param protobuf\Encoder $encoder
     */
    public function __construct(Encoder $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param string $file .proto file with specification
     * @param array $data object to encode
     * @return string binary string
     */
    protected function encode(array $spec, array $data)
    {
        $string = $this->encoder->encode($spec, $data);
        return $string;
    }

    /**
     * @param array $spec
     * @param array $data
     * @return mixed
     */
    abstract public function write(array $spec, array $data);
}