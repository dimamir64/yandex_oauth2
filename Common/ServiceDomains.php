<?php

namespace Common;

use function Yandex_Oauth2\Common\mb_strtoupper;

class ServiceDomains extends AbstractEnum
{
    const SERVICE_DOMAINS_AUTHORIZE = 'oauth.yandex.ru';
    const SERVICE_DOMAINS_TOKEN = 'oauth.yandex.ru';
    const SERVICE_DOMAINS_INFO = 'login.yandex.ru';

    protected static $validValues = array(
        'SERVICE_DOMAINS_AUTHORIZE' => true,
        'SERVICE_DOMAINS_TOKEN' => true,
        'SERVICE_DOMAINS_INFO' => true
    );

    public static function getServiceDomainValidateName(string $name): bool
    {
        return array_key_exists('SERVICE_DOMAINS_'.mb_strtoupper($name), self::getValidValues());
    }

    public static function getValue($name) {
        $name = 'SERVICE_DOMAINS_'.mb_strtoupper($name);
        return constant('static::'.$name);
    }

}