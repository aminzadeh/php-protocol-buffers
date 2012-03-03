<?php

namespace protobuf\io\writer;

/**
 * Write encoded string into file
 */
class File extends Writer
{
    /**
     * @var string
     */
    private $filename;

    /**
     * @param string $filename
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @param string $spec
     * @param array $data
     */
    public function write($spec, array $data)
    {
        $string = $this->encode($file, $data);

        file_put_contents($this->filename, $string);
    }
}