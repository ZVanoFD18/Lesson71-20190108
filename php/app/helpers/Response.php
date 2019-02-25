<?php

namespace Helper;

class Response
{
    static function send404($data = null)
    {
        header("HTTP/1.0 404 Not Found");
        self::sendJson(array(
            'success' => false,
            'message' => 'Страница не найдена',
            'data' => $data
        ));
        die();
    }

    static function sendJson(array $data)
    {
        $data = json_encode($data, JSON_FORCE_OBJECT);
        header('Content-Type:application/json');
        header('Content-Length: ' . strlen($data));
        echo $data;
        die();
    }

    static function checkCorsOrigin()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {
            return;
        }
        $origin = $_SERVER['HTTP_ORIGIN'];
        if ($origin === 'http://localhost:4200') {

            //header('Access-Control-Allow-Origin: ' . $origin );
            header('Access-Control-Allow-Origin: *');

            header('Access-Control-Allow-Credentials: true');

            //header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
            header('Access-Control-Allow-Methods: GET,HEAD,OPTIONS,POST,PUT');

            // header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Authorization");
            //header("Access-Control-Allow-Headers: *");

            //header('Access-Control-Allow-Headers: X-PINGARUNER');
            header('Access-Control-Max-Age: 1728000');
            header("Content-Length: 0");
            header("Content-Type: text/plain");
        } else {
            header("HTTP/1.1 403 Access Forbidden");
            header("Content-Type: text/plain");
            echo "You cannot repeat this request";
        }
        die();
    }
}