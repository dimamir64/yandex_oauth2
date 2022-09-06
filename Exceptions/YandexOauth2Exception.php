<?php
/*
 * YandexOauth2Exception.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Exceptions;

/**
 * Класс ошибок работы с сервисом  Яндекс
 * @version  1.0.0
 * @since 1.0.0
 */
class YandexOauth2Exception extends \Exception
{
    /**
     * Ошибка неизвестное наименование сервиса
     * @since 1.0.0
     */
    const YANDEX_OAUTH2_ERROR_UNKNOWN_SERVICE = 1;

    /**
     * Ошибка неизвестный метод запроса данных у сервисов
     * @since 1.0.0
     */
    const YANDEX_OAUTH2_ERROR_UNKNOWN_METHOD = 2;
}