<?php
/*
 * YandexOauth2.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Common;

use Joomla\CMS\Http\Http;
use Joomla\CMS\Http\HttpFactory;
use Joomla\CMS\Http\Response;
use Yandex_Oauth2\Exceptions\YandexOauth2Exception;

/**
 * Методы Яндекс OAUTH 2
 * @version  1.0.0
 * @since 1.0.0
 * @see https://yandex.ru/dev/id/doc/dg/index.html
 */
class YandexOauth2
{

    /**
     * Идентификатор OAuth-приложения, для которого был выдан переданный в запросе OAuth-токен.
     * @var string
     * @since 1.0.0
     */
    private $clientID = '';

    /**
     * Пароль приложения. Доступен в свойствах приложения
     * @var string
     * @since 1.0.0
     */
    private $clientSecret = '';

    /**
     * Агент соединения
     * @var Http
     * @since 1.0.0
     */
    protected $http = null;

    /**
     * @param string $clientID
     * @param string $clientSecret
     * @since 1.0.0
     */
    public function __construct(string $clientID, string $clientSecret)
    {
        $this->setClientSecret($clientSecret);
        $this->setClientID($clientID);
        $this->http = HttpFactory::getHttp(null, ['curl']);
    }

    /**
     * Отправка данных на сервис и получение ответа
     * @param string $service Имя сервиса к которому обращаемся
     * @param string $method Метод, который используется для обращения
     * @param array $options Опции соединения
     * @param array $data Передаваемые данные
     *
     * @return Response
     * @throws YandexOauth2Exception
     * @since 1.0.0
     */
    protected function requestHttp(string $service, string $method, array $options, array $data): Response
    {
        $this->_setHttpOptions($options);

        if (!ServiceDomains::getServiceDomainValidateName($service)) {
            throw new YandexOauth2Exception('Unknown service name', YandexOauth2Exception::YANDEX_OAUTH2_ERROR_UNKNOWN_SERVICE);
        }
        if (!HttpRequestMethods::getMethodValidateName($method)) {
            throw new YandexOauth2Exception('Unknown http method', YandexOauth2Exception::YANDEX_OAUTH2_ERROR_UNKNOWN_METHOD);
        }

        $url = 'https://' . ServiceDomains::getValue($service) . '/' . $service;
        try {
            $response = $this->http->$method($url, $data);
        } catch (\Exception $e) {
            throw new YandexOauth2Exception($e->getMessage(), $e->getCode());

        }
        return $response;
    }

    /**
     * Устанавливает опции соединения к сервису
     * @param array $options Опции соединения
     * @return void
     * @since 1.0.0
     */
    private function _setHttpOptions(array $options)
    {
        $this->http->setOption('transport.curl', $options);
    }

    /**
     * Получает идентификатор OAuth-приложения, для которого был выдан переданный в запросе OAuth-токен
     * @return string
     * @since 1.0.0
     */
    protected function getClientID(): string
    {
        return $this->clientID;
    }

    /**
     * Устанавливает идентификатор OAuth-приложения, для которого был выдан переданный в запросе OAuth-токен
     * @param string $clientID
     * @since 1.0.0
     */
    private function setClientID(string $clientID)
    {
        $this->clientID = $clientID;
    }

    /**
     * Получает пароль приложения
     * @return string
     * @since 1.0.0
     */
    protected function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * Устанавливает пароль приложения
     * @param string $clientSecret
     * @since 1.0.0
     */
    private function setClientSecret(string $clientSecret)
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * Декодирует сообщение сервиса об ошибке
     * @param Response $response
     * @return string[]
     * @since 1.0.0
     */
    protected function decodeErrorResponse(Response $response): array
    {
        $result = json_decode($response->body, true);
        if (is_array($result) && isset($result['error'])) {
            // handle a service error message
            $message = 'Service recponsed with error code "' . $result['error'] . '".';

            if (isset($result['error_description']) && $result['error_description']) {
                $message .= ' Description "' . $result['error_description'] . '".';
            }
            return $this->getErrorResponse($message);
        }
        // unknown error. not parsed error
        return $this->getErrorResponse('Unknown error. not parsed error');
    }

    /**
     * Формирует ответ с сообщением об ошибке
     * @param string $message Сообщение об ошибке
     * @return array
     * @since 1.0.0
     */
    protected function getErrorResponse(string $message): array
    {
        return array('error' => $message);
    }

    /**
     * Декодирует ответ сервиса, если нет ошибки
     * @param Response $response
     * @return array
     * @since 1.0.0
     */
    protected function decodeResponse(Response $response): array
    {
        return json_decode($response->body, true);
    }

    /**
     * Формирует ответ с полученными данными
     * @param mixed $result Данные для отправки
     * @return array
     * @since 1.0.0
     */
    protected function getResponse($result): array
    {
        return array('result' => $result);
    }
}