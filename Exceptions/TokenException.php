<?php

namespace Exceptions;
defined('_JEXEC') or die;

class TokenException extends \Exception
{
    const YANDEX_OAUTH2_TOKEN_ERROR_UNKNOWN_TOKEN_TYPE = 1;

}