<?php
/**
 * Created by PhpStorm.
 * User: Vano
 * Date: 17.02.2019
 * Time: 22:35
 */

namespace Helper;

class Response
{
    static function go404($data){

    }

    static function sendJson(array  $data){
        $data = json_encode($data);
        header('Content-Type:application/json');
        header( 'Content-Length: ' . strlen($data));
        echo $data;
        exit(0);
    }
}