<?php

namespace protobuf;

/**
 * Autoloader
 */
class Autoloader
{
    /**
     * @var string
     */
    private $rootPath;

    /**
     * @var array
     */
    private $classmap = array(
        'protobuf\Decoder' => 'Decorator.php',
        'protobuf\DecoratorImpl' => 'DecoratorImpl.php',
        'protobuf\Encoder' => 'Encoder.php',
        'protobuf\EncoderImpl' => 'EncoderImpl.php',
        'protobuf\Mapper' => 'Mapper.php',
        'protobuf\compiler\Parser' => 'compiler/Parser.php',
        'protobuf\compiler\ParserImpl' => 'compiler/ParserImpl.php',
        'protobuf\compiler\Tokenizer' => 'compiler/Tokenizer.php',
    );

    /**
     * Register self as SPL autoloader
     */
    public function __construct()
    {
        $this->rootPath = __DIR__ . DIRECTORY_SEPARATOR;
        spl_autoload_register(array($this, 'autoload'));
    }

    /**
     * Check if class exists in classmap
     *
     * @param string $class
     */
    public function autoload($class)
    {
        if (isset($this->classmap[$class])) {
            include $this->rootPath . $this->classmap[$class];
        }
    }
}