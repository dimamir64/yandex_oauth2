<?php

namespace Yandex_Oauth2\Common;


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
        $key = 'SERVICE_DOMAINS_'. mb_strtoupper($name);
        $arr = self::getValidValues();
        return in_array('SERVICE_DOMAINS_'. mb_strtoupper($name), self::getValidValues());
    }

    public static function getValue($name) {
        $name = 'SERVICE_DOMAINS_'.mb_strtoupper($name);
        return constant('static::'.$name);
    }

}