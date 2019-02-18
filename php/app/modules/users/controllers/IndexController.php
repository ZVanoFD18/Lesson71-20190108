<?php
//namespace Users;
use Helper\Response;

require_once APP_ROOT.'/app/helpers/Request.php';
require_once APP_ROOT.'/app/helpers/Response.php';
require_once APP_ROOT.'/app/modules/users/models/Users.php';

class IndexController
{
    public function __construct()
    {
        // @TODO: инициализация
    }
    public function listAction(){
        try{
            $data = Users::getList();
            Response::sendJson(array(
                'success' => true,
                'rows' => $data
            ));
        } catch (Exception $e){
            echo 'Test DB: FAIL<br>' . $e->getMessage();
        }
    }
    public function addAction(){

    }

    public function editAction(){

    }
}