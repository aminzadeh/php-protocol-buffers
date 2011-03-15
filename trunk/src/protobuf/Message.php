<?php
/**
 * @version $Revision$
 * @author $Author$ $Date$
 * @category protobuf
 * @package protobuf
 */

namespace protobuf;

use protobuf\io\reader\Reader;

use protobuf\io\reader\String;

use protobuf\compiler\ParserImpl;
use protobuf\io\writer\String as StringWriter;
use protobuf\io\writer\Writer as StringReader;

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
            $writer = self::createDefaultWriter();
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
            $reader = self::createDefaulrReader();
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
     * @return Writer
     */
    protected static function createDefaultWriter()
    {
        $encoder = new EncoderImpl();
        $parser = new ParserImpl();
        $writer = new StringWriter($encoder, $parser);
        return $writer;
    }

    /**
     * @return Reader
     */
    protected static function createDefaulrReader()
    {
        $decoder = new DecoderImpl();
        $parser = new ParserImpl();
        $reader = new StringReader($decoder, $parser);
        return $reader;
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
        $data = call_user_func_array(array($this->reader, 'read'), $args);
        return $data;
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
        $output =
            call_user_func_array(array($this->getWriter(), 'write', $args));
        return $output;
    }
}