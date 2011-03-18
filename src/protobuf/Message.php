<?php
/**
 * @version $Revision$
 * @author $Author$ $Date$
 * @category protobuf
 * @package protobuf
 */

namespace protobuf;

use protobuf\compiler\ParserImpl;
use protobuf\io\reader\Reader;
use protobuf\io\reader\String;
use protobuf\io\writer\String as StringWriter;
use protobuf\io\writer\String as StringReader;

/**
 * Abstract Message
 */
abstract class Message
{
    /**
     * @var array
     */
    protected $container = array();

    /**
     * @var Reader
     */
    protected $reader;

    /**
     * @var Writer
     */
    protected $writer;

    /**
     * @var Encoder
     */
    protected $encoder;

    /**
     * @var Decoder
     */
    protected $decoder;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return $this->has($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return Message
     */
    public function set($name, $value)
    {
        $this->container[$name] = $value;
        return $this;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        return $this->container[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has($name)
    {
        return isset($this->container[$name]);
    }

    /**
     * @return Writer
     */
    public function getWriter()
    {
        if (null === $this->writer) {
            $parser = $this->getParser();
            $encoder = $this->getEncoder();
            $writer = self::createDefaultWriter($parser, $encoder);
            $this->setWriter($writer);
        }
        return $this->writer;
    }

    /**
     * @return Reader
     */
    public function getReader()
    {
        if (null === $this->reader) {
            $parser = $this->getParser();
            $decoder = $this->getDecoder();
            $reader = self::createDefaultReader($parser, $decoder);
            $this->setReader($reader);
        }
        return $this->reader;
    }

    /**
     * @param Writer $writer
     * @return Message
     */
    public function setWriter(Writer $writer)
    {
        $this->writer = $writer;
        return $this;
    }

    /**
     * @param Reader $reader
     * @return Message
     */
    public function setReader(Reader $reader)
    {
        $this->reader = $reader;
        return $this;
    }

    /**
     * @param Encoder $encoder
     * @return Message
     */
    public function setEncoder(Encoder $encoder)
    {
        $this->encoder = $encoder;
        return $this;
    }

    /**
     * @param Decoder $decoder
     * @return Message
     */
    public function setDecoder(Decoder $decoder)
    {
        $this->decoder = $decoder;
        return $this;
    }

    /**
     * @return Decoder
     */
    protected static function createDefaultDecoder()
    {
        $decoder = new DecoderImpl();
        return $decoder;
    }

    /**
     * @return Encoder
     */
    protected static function createDefaultEncoder()
    {
        $encoder = new EncoderImpl();
        return $encoder;
    }

    /**
     * @return Encoder
     */
    public function getEncoder()
    {
        if (null === $this->encoder) {
            $this->encoder = self::createDefaultEncoder();
        }
        return $this->encoder;
    }

    /**
     * @return Decoder
     */
    public function getDecoder()
    {
        if (null === $this->decoder) {
            $this->decoder = self::createDefaultDecoder();
        }
        return $this->decoder;
    }

    /**
     * @param Parser $parser
     * @param Encoder $encoder
     * @return Writer
     */
    protected static function createDefaultWriter(Parser $parser
        , Encoder $encoder)
    {
        $writer = new StringWriter($encoder, $parser);
        return $writer;
    }

    /**
     * @param Parser $parser
     * @param Decoder $decoder
     * @return Reader
     */
    protected static function createDefaultReader(Parser $parser
        , Decoder $decoder)
    {
        $reader = new StringReader($decoder, $parser);
        return $reader;
    }

    /**
     * @param Parser $parser
     * @return Message
     */
    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
        return $this;
    }

    /**
     * @return Parser
     */
    protected static function createDefaultParser()
    {
        $parser = new ParserImpl();
        return $parser;
    }

    /**
     * @return Parser
     */
    public function getParser()
    {
        if (null === $this->parser) {
            $this->parser = self::createDefaultParser();
        }
        return $this->parser;
    }

    /**
     * Proxy method for {@link protobuf\io\reader\Reader::read()}
     * Use the same arguments as aggregated reader
     *
     * @return array
     * @uses protobuf\io\reader\Reader::read()
     */
    public function read()
    {
        $args = func_get_args();
        $data = call_user_func_array(array($this->getReader(), 'read'), $args);
        $this->container = $data;
    }

    /**
     * Proxy method for {@link protobuf\io\writer\Writer::write()}
     * Used the same arguments as aggregated writer
     *
     * @return mixed
     * @uses protobuf\io\writer\Writer::write()
     */
    public function write()
    {
        $args = func_get_args();
        $result =
            call_user_func_array(array($this->getWriter(), 'write', $args));
        return $result;
    }

    /**
     * Proxy method for {@link protobuf\Decoder::decode()}
     *
     * @param string $string
     * @todo define specification
     */
    public function decode($string)
    {
        $spec = array();
        $data = $this->getDecoder()->decode($spec, $string);
        $this->container = $data;
    }

    /**
     * Proxy method for {@link protobuf\Encoder::encode()}
     *
     * @return string Binary-encoded string
     * @todo define specification
     */
    public function encode()
    {
        $spec = array();
        $data = $this->container;
        $string = $this->getEncoder()->encode($spec, $data);
        return $string;
    }
}