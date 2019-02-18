<?php
require_once APP_ROOT.'/app/Db.php';

class Auth
{
    static function getHash($pass){
        $result = sha1($pass);
        return $result;
    }
    static function login($login, $pass){
        $passHash = self::getHash($pass);
        $sql = <<<SQL
SELECT t.id, t.login, t.display_name
FROM auth\$users t
WHERE 
  t.login = :login
  AND 
  t.pass_hash = :hash 
SQL;
        $conn = Db::getConnection();
        $sth = $conn->prepare($sql);
        $sth->bindValue('login', $login);
        $sth->bindValue('hash', $passHash);
        if(!$sth->execute()){
            throw new Exception(__METHOD__ . '/Что-то не так.');
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        if(sizeof($data) !== 1){
            return false;
        }
        return $data[0];
    }
}