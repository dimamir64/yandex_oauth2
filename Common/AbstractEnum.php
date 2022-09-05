<?php


namespace  Common;

defined( '_JEXEC' ) or die;


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
    public static function valueExists($value)
    {
        return array_key_exists($value, static::$validValues);
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
     * @return string[] Массив разрешённых значений
     * @since 1.0.0
     */
    public static function getEnabledValues()
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
    public static function getEnums() {
        $result = array();
        foreach (static::$validValues as $key => $enabled) {
            if ($enabled) {
                $result[] = array('name'=>$key,'value'=>constant('static::'.$key));
            }
        }
        return $result;
    }
    public static function getEnumName ($value){
        foreach (static::$validValues as $key => $val) {
            if ($value == constant('static::'.$key)) {
                return $key;
            }
        }
        return false;
    }
}