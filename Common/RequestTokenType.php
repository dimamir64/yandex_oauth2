<?php

namespace Yandex_Oauth2\Common;

class RequestTokenType extends AbstractEnum
{
    const REQUEST_TOKEN_TYPE_BY_CODE = 'code';
    const REQUEST_TOKEN_TYPE_BY_TOKEN = 'token';

    protected static $validValues = array(
        'REQUEST_TOKEN_TYPE_BY_CODE' => true,
        'REQUEST_TOKEN_TYPE_BY_TOKEN' => true
    );
}