<?php
require_once APP_ROOT.'/app/Db.php';
require_once APP_ROOT.'/configs/Config.php';
require_once APP_ROOT.'/app/helpers/Request.php';
class IndexController
{
    public function __construct()
    {
        // @TODO: инициализация
    }
    public function phpinfoAction(){
        phpinfo();
    }
    public function testRequestAction(){
        var_dump($_REQUEST);
    }

    public function testdbAction(){
        try{
            $conn = Db::getConnection();
            echo 'Test DB: OK';
        } catch (Exception $e){
            echo 'Test DB: FAIL<br>' . $e->getMessage();
        }
    }
    public function createdbAction(){
        $login = Helper\Request::getParam('login');
        $pass = Helper\Request::getParam('pass');
        Config::checkSuperuser($login, $pass);
        try{
            $conn = Db::getConnection(false);
            $sql = file_get_contents(APP_ROOT . '/db-scripts/000000.sql');
            $conn->query($sql);
            //$stmt = db::getConnection()->prepare($sql);
            //$stmt->execute();
            echo 'Create DB: OK';
            echo '</br>' . $sql;
        } catch (Exception $e){
            echo 'Test DB: FAIL<br>' . $e->getMessage();
        }
    }
}