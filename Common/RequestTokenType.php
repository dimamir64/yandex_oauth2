<?php
/*
 * RequestTokenType.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Common;

/**
 * Нумератор типов запроса токена
 * @version 1.0.0
 * @since 1.0.0
 */
class RequestTokenType extends AbstractEnum
{
    /**
     * Тип запроса по параметру code
     * @since 1.0.0
     */
    const REQUEST_TOKEN_TYPE_BY_CODE = 'code';

    /**
     * Тип запроса по параметру token
     * @since 1.0.0
     */
    const REQUEST_TOKEN_TYPE_BY_TOKEN = 'token';

    /**
     * Разрешенные типы запросов
     * @var array
     * @since 1.0.0
     */
    protected static $validValues = array(
        'REQUEST_TOKEN_TYPE_BY_CODE' => true,
        'REQUEST_TOKEN_TYPE_BY_TOKEN' => true
    );
}