<?php
/*
 * Token.php
 * Created for project JOOMLA 3.x
 * package yandex_oauth2
 * version 1.0.0
 * https://econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2022 Econsult Lab.
 */

namespace Yandex_Oauth2\Common;

use DateTime;
use Exception;
use Yandex_Oauth2\Exceptions\TokenException;

defined('_JEXEC') or die;

/**
 * Токен авторизации
 * @see https://yandex.ru/dev/id/doc/dg/oauth/reference/web-client.html
 * @version 1.0.0
 * @since 1.0.0
 */
class Token
{
    /**
     * OAuth-токен с запрошенными правами или с правами, указанными при регистрации приложения.
     * @var string
     * @since 1.0.0
     */
    private $_access_token = '';

    /**
     * Тип выданного токена. Всегда принимает значение «bearer».
     * @var string
     * @since 1.0.0
     */
    private $_token_type = '';

    /**
     * Дата и время окончания действия токена
     * @var DateTime|null
     * @since 1.0.0
     */
    private $_expireDateTime = null;

    /**
     * Значение параметра state из исходного запроса, если этот параметр был передан.
     * @var string
     * @since 1.0.0
     */
    private $_state = '';

    /**
     * Права, запрошенные разработчиком или указанные при регистрации приложения.
     * Поле scope является дополнительным и возвращается, если OAuth предоставил токен с меньшим набором прав, чем было запрошено.
     * @var string
     * @since 1.0.0
     */
    private $_scope = '';

    /**
     * @param string $access_token OAuth-токен с запрошенными правами или с правами, указанными при регистрации приложения.
     * @param string $token_type Тип выданного токена. Всегда принимает значение «bearer».
     * @param int $expires_in Время жизни токена в секундах
     * @param string $state Значение параметра state из исходного запроса, если этот параметр был передан.
     * @param string $scope Права, запрошенные разработчиком или указанные при регистрации приложения. Поле scope является дополнительным и возвращается, если OAuth предоставил токен с меньшим набором прав, чем было запрошено.
     * @throws Exception
     * @since 1.0.0
     */
    public function __construct(string $access_token, string $token_type, int $expires_in, string $state, string $scope)
    {
        $this->_access_token = $access_token;
        if (TokenType::valueExists($token_type)) {
            $this->_token_type = $token_type;
        } else {
            // ошибка не корректный тип токена
            throw new TokenException('Unknown token type', TokenException::YANDEX_OAUTH2_TOKEN_ERROR_UNKNOWN_TOKEN_TYPE);
        }
        $expireDateTime = new DateTime();
        $expireDateTime->add(new \DateInterval('PT' . $expires_in . 'S'));
        $this->_expireDateTime = $expireDateTime;
        $this->_state = $state;
        $this->_scope = $scope;
    }

    /**
     * Получить дату и время окончания действия токена
     * @return DateTime
     * @since 1.0.0
     */
    public function getExpireDateTime(): DateTime
    {
        return $this->_expireDateTime;
    }

    /**
     * Получить OAuth-токен с запрошенными правами или с правами, указанными при регистрации приложения
     * @return string
     * @since 1.0.0
     */
    public function getAccessToken(): string
    {
        return $this->_access_token;
    }

    /**
     * Проверка действительности токена по дате и времени окончания действия
     * @return bool
     * @since 1.0.0
     */
    public function isTokenValid()
    {
        return $this->_expireDateTime >= new DateTime();
    }
}