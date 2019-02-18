<?php

namespace Helper;

class Response
{
    static function send404($data = null){
        header("HTTP/1.0 404 Not Found");
        self::sendJson(array(
            'success' => false,
            'message' => 'Страница не найдена',
            'data' => $data
        ));
        die();
    }

    static function sendJson(array  $data){
        $data = json_encode($data);
        header('Content-Type:application/json');
        header( 'Content-Length: ' . strlen($data));
        echo $data;
        die();
    }
}