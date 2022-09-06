<?php
/*
 * AbstractEnum.php
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
 * Абстрактный класс нумератора
 * @version 1.0.0
 * @since 1.0.0.
 */
abstract class AbstractEnum
{
    /**
     * @var array Массив принимаемых enum'ом значений
     * @since 1.0.0
     */
    protected static $validValues = array();

    /**
     * Проверяет наличие значения в enum'e
     * @param mixed $value Проверяемое значение
     * @return bool True если значение имеется, false если нет
     * @since 1.0.0
     */
    public static function valueExists($value): bool
    {
        foreach (static::$validValues as $key => $e_value) {
            if (constant('static::' . $key) === $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * Возвращает все значения в enum'e
     * @return array Массив значений в перечислении
     * @since 1.0.0
     */
    public static function getValidValues()
    {
        return array_keys(static::$validValues);
    }


    /**
     * Возвращает значения в enum'е значения которых разрешены
     * @return array Массив разрешённых значений
     * @since 1.0.0
     */
    public static function getEnabledValues(): array
    {
        $result = array();
        foreach (static::$validValues as $key => $enabled) {
            if ($enabled) {
                $result[] = $key;
            }
        }
        return $result;
    }

    /**
     * Возвращает массив значений нумератора
     * имя и значение
     *
     * @return array
     *
     * @since 1.0.0
     */
    public static function getEnums(): array
    {
        $result = array();
        foreach (static::$validValues as $key => $enabled) {
            if ($enabled) {
                $result[] = array('name' => $key, 'value' => constant('static::' . $key));
            }
        }
        return $result;
    }

    /**
     * Возвращает наименование нумератора по значению
     * @param mixed $value Значение нумератора
     * @return string|false
     * @since 1.0.0
     */
    public static function getEnumName($value)
    {
        foreach (static::$validValues as $key => $val) {
            if ($value == constant('static::' . $key)) {
                return $key;
            }
        }
        return false;
    }
}
