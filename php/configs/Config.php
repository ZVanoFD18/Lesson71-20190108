<?php
class Config
{
    static function getDbOptions(){
        // 'mysql:host=localhost;dbname=petitions', 'root', ''
//        return array(
//            'connString' => 'mysql:host=localhost;dbname=petitions',
//            'login' => 'root',
//            'pass' => ''
//        );
        return array(
            'connString' => 'sqlite:' . realpath(APP_ROOT. '/db/angularVisit.sqlite'),
            'login' => '',
            'pass' => '',
            'db_version' => 0
        );

    }
    static function getRoutes(){
        return array(
            '/phpinfo/' => 'common/index/phpinfo',
            '/testRequest/' => 'common/index/testRequest',
            '/testdb/' => 'common/index/testdb',
            '/createdb/' => 'common/index/createdb',
            '/users/list'  => 'users/index/list'
        );
    }

    static function getSuperusers(){
        return (array(
            'admin0' => 'admin0',
            'admin1' => 'admin1'
        ));
    }
    public static function checkSuperuser($login, $pass){
        $superusers = self::getSuperusers();
        if(!array_key_exists($login, $superusers)){
            throw new Exception('Пользователь не существует');
        }
        if($superusers[$login] !== $pass){
            throw new Exception('Пароль неверен');
        }
        return true;
    }

}