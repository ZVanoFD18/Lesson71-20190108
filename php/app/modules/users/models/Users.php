<?php
require_once APP_ROOT.'/app/Db.php';

class Users
{
    static function getList(){
        $conn = Db::getConnection();
        $sql = <<<SQL
SELECT t.id, t.login, t.display_name
from auth\$users t
SQL;
        $sth = $conn->prepare($sql);
        if(!$sth->execute()){
            throw new Exception(__METHOD__ . '/Что-то не так.');
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}