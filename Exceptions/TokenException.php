<?php
/*
 * TokenException.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Exceptions;
defined('_JEXEC') or die;

/**
 * Класс ошибок получения токена
 * @version  1.0.0
 * @since 1.0.0
 */
class TokenException extends \Exception
{
    /**
     * Ошибка не корректный тип токена
     * @since 1.0.0
     */
    const YANDEX_OAUTH2_TOKEN_ERROR_UNKNOWN_TOKEN_TYPE = 1;
}