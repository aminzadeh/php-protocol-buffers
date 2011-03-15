#!/usr/bin/env php
<?php

class A
{
    public $field = 'value';
}

$a = new A();

$reflection = new ReflectionClass('A');

// echo $reflection;
echo ReflectionClass::export('A', true);
