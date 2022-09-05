<?php

namespace YandexId;

use Common\RequestTokenType;
use Common\Token;
use Common\YandexOauth2;
use Exceptions\YandexOauth2Exception;

defined('_JEXEC') or die;

class YandexId extends YandexOauth2
{

    /**
     * Запрашивает информацию о профиле в Яндекс.Id
     * @see https://yandex.ru/dev/id/doc/dg/oauth/reference/auto-code-client.html
     * @param array $params Параметры запроса информации
     * @return array
     * @since 1.0.0
     */
    public function getUserInfo(array $params): array
    {
        if (isset($params['request_by'])) {
            switch ($params['request_by']) {
                case RequestTokenType::REQUEST_TOKEN_TYPE_BY_TOKEN:
                    // TODO не реализовано в текущей версии
                    return $this->getErrorResponse('Error not realised user info method by the token.');

                case RequestTokenType::REQUEST_TOKEN_TYPE_BY_CODE :
                    if (isset($params['code']) && !empty($params['code'])) {
                        $token = $this->_requestToken($params['code']);
                        if (isset($token['error'])) {
                            return $token;
                        }

                        if (isset($token['result']) && (method_exists($token['result'], 'isTokenValid()') && !$token['result']->isTokenValid())) {
                            return $this->getErrorResponse('Token is expired');
                        }

                        $params = array(
                            'format' => 'json',
                            //'jwt_secret'          => '',
                            'with_openid_identity' => 0
                        );

                        return $this->_requestUserInfo($params, $token['result']);
                    }
                    return $this->getErrorResponse('User code is not valid or not received');

                default:
                    return $this->getErrorResponse('Error by request unknown user info method.');
            }
        }
        return $this->getErrorResponse('Error by no specified the user info method.');
    }

    /**
     * Запрашивает токен по коду подтверждения
     * @see https://yandex.ru/dev/id/doc/dg/oauth/reference/auto-code-client.html
     * @param string $code Код подтверждения
     * @return array
     * @since 1.0.0
     */
    private function _requestToken(string $code): array
    {
        $params = array(
            'grant_type' => 'authorization_code',
            'code' => $code,
            'client_id' => $this->getClientID(),
            'client_secret' => $this->getClientSecret()
        );

        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_POST => 1,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        try {
            $response = $this->requestHttp('token', 'post', $options, $params);
            if ($response->code == 200) {
                $token_data = $this->decodeResponse($response);
                return $this->getResponse(
                    new Token(
                        $token_data['access_token'],
                        $token_data['token_type'] ?? 'bearer',
                        $token_data['expires_in'],
                        $token_data['state'] ?? '',
                        $token_data['scope'] ?? ''
                    )
                );
            } else if ($response->code >= 400) {
                return $this->decodeErrorResponse($response);
            }
        } catch (YandexOauth2Exception $e) {
            return $this->getErrorResponse('Request token responses with error: ' . $e->getMessage() . ' code:' . $e->getCode());
        } catch (\Exception $e) {
            return $this->getErrorResponse('Request token responses with error: ' . $e->getMessage() . ' code:' . $e->getCode());
        }
        return $this->getErrorResponse('Request token responses with unknown error');
    }

    /**
     * Запрашивает информацию о профиле Яндекс по токену
     * @see https://yandex.ru/dev/id/doc/dg/api-id/reference/request.html
     * @param array $params
     * @param Token $token
     * @return array
     * @since 1.0.0
     */
    private function _requestUserInfo(array $params, Token $token): array
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json', 'Authorization: OAuth ' . $token->getAccessToken()),
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        );
        try {
            $response = $this->requestHttp('info', 'get', $options, $params);
            if ($response->code == 200) {
                $user_info = $this->decodeResponse($response);
                return $this->getResponse($user_info);
            } else if ($response->code >= 400) {
                return $this->decodeErrorResponse($response);
            }
        } catch (YandexOauth2Exception $e) {
            return $this->getErrorResponse('Request user info responses with error: ' . $e->getMessage() . ' code:' . $e->getCode());
        } catch (\Exception $e) {
            return $this->getErrorResponse('Request user info responses with error: ' . $e->getMessage() . ' code:' . $e->getCode());
        }
        return $this->getErrorResponse('Request user info responses with unknown error');
    }
}