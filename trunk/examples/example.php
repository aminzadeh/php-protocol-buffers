<?php

include '../src/protobuf/Autoloader.php';
new protobuf\Autoloader();

$parser = new protobuf\compiler\ParserImpl();
$parser->setRootPath('proto');
$parser->setCachePath('cache');
$data = $parser->parse('Person.proto');

var_dump($data);