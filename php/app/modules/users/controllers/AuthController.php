<?php
//namespace Users;
use Helper\Response;

require_once APP_ROOT.'/app/helpers/Request.php';
require_once APP_ROOT.'/app/helpers/Response.php';
require_once APP_ROOT.'/app/modules/users/models/Auth.php';

class AuthController
{
    public function __construct()
    {
        // @TODO: инициализация
    }
    public function loginAction(){
        $login = \Helper\Request::getParam('login');
        $pass = \Helper\Request::getParam('pass');
        if ($data = Auth::login($login, $pass)){
            \Helper\Response::sendJson(array(
                'success' => true,
                'result' => $data['id']
            ));
        } else{
            Response::sendJson(array(
                'success' => false,
                'message' => 'Логин или пароль неверен'
            ));

        }
    }
}