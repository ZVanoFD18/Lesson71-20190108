<?php
require_once (APP_ROOT . '/configs/Config.php');
require_once (APP_ROOT . '/app/Router.php');
require_once (APP_ROOT . '/app/Db.php');

class App
{
    public static function Run(){
        header("Access-Control-Allow-Origin: *");
        self::_initLog();
        self::_initDb();
        $routes = Config::getRoutes();
        Router::Route($routes);
    }
    protected static function _initDb(){
        $dbParams = Config::getDbOptions();
        Db::setParams($dbParams['connString'], $dbParams['login'], $dbParams['pass'], $dbParams['db_version']);
    }
    protected static function _initLog(){
    }
}