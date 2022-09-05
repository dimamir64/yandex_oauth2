<?php

namespace Yandex_Oauth2\Exceptions;

class YandexOauth2Exception extends \Exception
{
    const YANDEX_OAUTH2_ERROR_UNKNOWN_SERVICE = 1;
    const YANDEX_OAUTH2_ERROR_UNKNOWN_METHOD = 2;

}