<?php

namespace Yandex_Oauth2\Common;

defined('_JEXEC') or die;

class TokenType extends AbstractEnum
{

    const TOKEN_TYPE_BEARER = 'bearer';

    protected static $validValues = array(
        'TOKEN_TYPE_BEARER' => true
    );
}