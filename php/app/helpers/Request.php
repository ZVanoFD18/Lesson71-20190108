<?php
namespace Helper;

class Request
{
    static function hasParam($name){
        return array_key_exists($name, $_REQUEST);
    }
    static function getParam($name, $default = null){
        if(!self::hasParam($name)){
            return $default;
        }
        return $_REQUEST[$name];
    }
    static function getParamFloat($name){
        $param = self::getParam($name);
        $param = floatval($param);
        return $param;
    }
    static function getParamDatetime($name, $format='Y-m-d h:i:s'){
        $param = self::getParam($name);
        $param = DateTime::createFromFormat($format, $param);
        return $param;
    }
    static function getParamDate($name, $format='Y-m-d'){
        $param = self::getParam($name);
        $param = DateTime::createFromFormat($format, $param);
        return $param;
    }

    /**
     * Пытается прочитать JSON из тела запроса.
     * Если исключение, то возвпащает true через out-параметр $isError
     * @param $isError
     * @param null $defValue
     * @return null|object
     */
    static function getPostJson(&$isError, $defValue=null){
        $result = null;
        try{
            $result = file_get_contents('php://input');
            $result = json_decode($result);
        } catch (\Error $e){
            $isError = true;
            Log::addError($e);
            return $defValue;
        }
        return $result;
    }

    /**
     * Возвращает Cookie с заданным именем.
     * @param $name
     * @param null $defVal
     * @return null
     */
    static function getCookie($name, $defVal=null){
        if(!array_key_exists($name, $_COOKIE)){
            return $defVal;
        }
        return $_COOKIE[$name];
    }

}