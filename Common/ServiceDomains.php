<?php
/*
 * ServiceDomains.php
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
 * Нумератор URL сервисов
 * @version 1.0.0
 * @since 1.0.0
 */
class ServiceDomains extends AbstractEnum
{
    /**
     * Сервис авторизации
     * @since 1.0.0
     */
    const SERVICE_DOMAINS_AUTHORIZE = 'oauth.yandex.ru';

    /**
     * Сервис запроса токена
     * @since 1.0.0
     */
    const SERVICE_DOMAINS_TOKEN = 'oauth.yandex.ru';

    /**
     * Сервис запроса информации о профиле пользователя
     * @since 1.0.0
     */
    const SERVICE_DOMAINS_INFO = 'login.yandex.ru';

    /**
     * Разрешенные сервисы
     * @var array
     * @since 1.0.0
     */
    protected static $validValues = array(
        'SERVICE_DOMAINS_AUTHORIZE' => true,
        'SERVICE_DOMAINS_TOKEN' => true,
        'SERVICE_DOMAINS_INFO' => true
    );

    /**
     * Проверка на разрешенное имя сервиса
     * @param string $name Имя сервиса (например, 'token')
     * @return bool
     * @since 1.0.0
     */
    public static function getServiceDomainValidateName(string $name): bool
    {
        return in_array('SERVICE_DOMAINS_' . mb_strtoupper($name), self::getValidValues());
    }

    /**
     * Получить URL по имени сервиса (например, 'token')
     * @param string $name Имя сервиса (например, 'token')
     * @return string|null
     * @since 1.0.0
     */
    public static function getValue(string $name): string
    {
        $name = 'SERVICE_DOMAINS_' . mb_strtoupper($name);
        return constant('static::' . $name);
    }

}