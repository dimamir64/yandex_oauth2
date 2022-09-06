<?php
/*
 * HttpRequestMethods.php
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
 *  Нумератор методов запроса данных у сервиса
 * @version 1.0.0
 * @since 1.0.0
 */
class HttpRequestMethods extends AbstractEnum
{
    /**
     * Метод POST
     * @since 1.0.0
     */
    const HTTP_REQUEST_METHOD_POST = 'post';

    /**
     * Метод GET
     * @since 1.0.0
     */
    const HTTP_REQUEST_METHOD_GET = 'get';

    /**
     * Разрешенные значения
     * @var array
     * @since 1.0.0
     */
    protected static $validValues = array(
        'HTTP_REQUEST_METHOD_POST' => true,
        'HTTP_REQUEST_METHOD_GET' => true
    );

    /**
     * Проверяет разрешено ли название метода
     * @param string $name Название метода
     * @return bool
     * @since 1.0.0
     */
    public static function getMethodValidateName(string $name): bool
    {
        return in_array('HTTP_REQUEST_METHOD_' . mb_strtoupper($name), self::getValidValues());
    }
}