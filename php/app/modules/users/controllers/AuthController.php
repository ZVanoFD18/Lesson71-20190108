<?php
//namespace Users;
use Helper\Response;

require_once APP_ROOT . '/app/helpers/Request.php';
require_once APP_ROOT . '/app/helpers/Response.php';
require_once APP_ROOT . '/app/modules/users/models/Auth.php';

class AuthController
{
    public function __construct()
    {
        // @TODO: инициализация
    }

    /**
     * Логин пользователя.
     * Автоматическое определение метода авторизации.
     */
    public function loginAction()
    {
        $login = \Helper\Request::getParam('login');
        $pass = \Helper\Request::getParam('pass');
        if ($data = Auth::login($login, $pass)) {
            setcookie('sid', $data['sid'], time() + (10 * 365 * 24 * 60 * 60), '/');
            \Helper\Response::sendJson(array(
                'success' => true,
                'message' => 'Пароль истекает через 15 дней. Следует сменить пароль в разделе "Профиль/Сменить пароль"',
                'data' => $data
            ));
        } else {
            Response::sendJson(array(
                'success' => false,
                'message' => 'Логин или пароль неверен'
            ));

        }
    }

    /**
     * Выход из системы.
     * Позволено по параметру либо по cookie.
     */
    public function logoutAction()
    {
        $sid = null;
        // Извлекаем из GET
        if (is_null($sid)) {
            $sid = \Helper\Request::getParam('sid');
        }
        // Извлекаем из POST
        $reqJson = \Helper\Request::getPostJson($isError);
        if (!$isError && is_object($reqJson)){
            $sid = $reqJson->sid;
        }
        // Извлекаем из COOKIE
        if (is_null($sid)) {
            $sid = \Helper\Request::getCookie('sid');
        }
        if (is_null($sid)) {
            \Helper\Response::sendJson(array(
                'success' => false,
                'message' => 'Не задан SID пользовательской сессии'
            ));
        }
        if (!Auth::logout($sid)) {
            \Helper\Response::sendJson(array(
                'success' => false,
                'message' => 'Не удалось выполнить выход из системы'
            ));
        }
        setcookie('sid', null, -1, '/');
        \Helper\Response::sendJson(array(
            'success' => true,
            'data' => array(
                'sid' => $sid
            )
        ));
    }

    public function registerAction(){
        \Helper\Response::checkCorsOrigin();
        $params = \Helper\Request::getPostJson($isError);
        if ($isError && !is_object($params)){
            \Helper\Response::sendJson(array(
                'success' => false,
                'message' => 'Не переданы параметры'
            ));
        }
        if (!Auth::register($params)) {
            \Helper\Response::sendJson(array(
                'success' => false,
                'message' => 'Не удалось создать пользованеля'
            ));
        }
        \Helper\Response::sendJson(array(
            'success' => true,
            'message' => 'Выполните подтверждение регистрации'
        ));
    }
}