<?php

namespace protobuf\io\writer;

use protobuf\compiler\Parser;
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
     * @var protobuf\compiler\Parser
     */
    protected $parser;

    /**
     * @param protobuf\Encoder $encoder
     * @param protobuf\compiler\Parser $parser
     */
    public function __construct(Encoder $encoder, Parser $parser)
    {
        $this->encoder = $encoder;
        $this->parser = $parser;
    }

    /**
     * @param string $file .proto file with specification
     * @param array $data object to encode
     * @return string binary string
     */
    protected function encode($file, array $data)
    {
        $spec = $this->parser->parse($file);
        $string = $this->encoder->encode($spec, $object);
        return $string;
    }

    /**
     * @param string $spec
     * @param array $data
     * @return mixed
     */
    abstract public function write($spec, array $data);
}