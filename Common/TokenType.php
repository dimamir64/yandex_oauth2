<?php
/*
 * TokenType.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Common;

defined('_JEXEC') or die;

/**
 * Тип токена авторизации
 * @version 1.0.0
 * @since 1.0.0
 */
class TokenType extends AbstractEnum
{

    /**
     * Тип токена bearer
     * @since 1.0.0
     */
    const TOKEN_TYPE_BEARER = 'bearer';

    /**
     * Разрешенные типы токенов
     * @var array
     * @since 1.0.0
     */
    protected static $validValues = array(
        'TOKEN_TYPE_BEARER' => true
    );
}