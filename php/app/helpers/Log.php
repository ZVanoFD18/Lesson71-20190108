<?php

namespace Helper;


class Log
{
    /**
     * Перечень зарегистрированных логгеров, в которые следует писать сообщения.
     * @var array
     */
    protected static $_loggers = array();

    public static function addError(\Exception $e, $data = null)
    {
        // @TODO: Реализовать логирование ошибок
    }
}