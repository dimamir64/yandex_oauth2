<?php

namespace Common;

class HttpRequestMethods extends AbstractEnum
{
    const HTTP_REQUEST_METHOD_POST = 'post';
    const HTTP_REQUEST_METHOD_GET = 'get';
    protected static $validValues = array(
        'HTTP_REQUEST_METHOD_POST' => true,
        'HTTP_REQUEST_METHOD_GET' => true
    );

    public static function getMethodValidateName(string $name): bool
    {
        return array_key_exists('HTTP_REQUEST_METHOD_'.mb_strtoupper($name), self::getValidValues());
    }
}