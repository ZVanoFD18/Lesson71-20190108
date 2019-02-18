<?php
require_once APP_ROOT.'/app/helpers/Response.php';

use Helper\Response;

class Router
{
    static function Route($routes){
        $uri = $_SERVER['REQUEST_URI'];
        foreach ($routes as $uriPattern => $route){
            $isFound = false;
            if ($uriPattern === $uri){
                $isFound = true;
            }
            if (!$isFound && @preg_match($uriPattern, $uri)){
                $isFound = true;
            }
            if (!$isFound ){
                continue;
            }
            // echo '<br> Нашли';
            $segments = explode('/', $route);
            $module = array_shift($segments);
            $controller = ucfirst(array_shift($segments)) . 'Controller';
            $action = array_shift($segments). 'Action';
            $controllerFile = APP_ROOT . '/app/modules/' . $module . '/controllers/' . $controller . '.php';
            $controllerFile = str_replace('/', DIRECTORY_SEPARATOR, $controllerFile);

            if (!file_exists($controllerFile)){
                throw new Exception('Файл не существует'. $controllerFile);
            }
            require_once $controllerFile;
            $controllerObj = new $controller;
            $controllerObj->$action();
        }
        Response::send404(array(
            'uri' => $uri
        ));
    }
}