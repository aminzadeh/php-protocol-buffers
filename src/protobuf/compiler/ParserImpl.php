<?php

namespace protobuf\compiler;

/**
 * Parse .proto file into PHP array
 */
class ParserImpl implements Parser
{
    /**
     * @var string
     */
    private $rootPath = '';

    /**
     * @var string
     */
    private $cachePath = '';

    /**
     * @param string $rootPath
     */
    public function setRootPath($rootPath)
    {
        $this->rootPath = $rootPath . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $cachePath
     */
    public function setCachePath($cachePath)
    {
        $this->cachePath = $cachePath . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $file
     * @return array
     * @todo Implements .proto file parsing into PHP array
     */
    public function parse($file)
    {
        $filename = $this->rootPath . $file;
//        $cacheFile = $this->cachePath . $file . '.php';
//        if (is_readable($cacheFile)) {
//            $data = include $cacheFile;
//            return $data;
//        }

        $source = file_get_contents($filename);
        $tokens = Tokenizer::parse($source);

        $data = $tokens;
        return $tokens;
    }
}