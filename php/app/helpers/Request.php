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

}