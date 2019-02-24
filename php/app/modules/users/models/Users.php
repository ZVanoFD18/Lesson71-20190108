<?php
require_once APP_ROOT.'/app/Db.php';

class Users
{
    static function getList(){
        $sql = <<<SQL
SELECT t.id, t.login, t.display_name
from auth\$users t
SQL;
        $conn = Db::getConnection();
        $stmt = $conn->prepare($sql);
        if(!$stmt->execute()){
            throw new Exception(__METHOD__ . '/Что-то не так.');
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    static function add(
        $displayName,
        $login,
        $pass,
        $eMail,
        $phone,
        $changeQuestion,
        $changeAnswer
    ){
        $sql = <<<SQL
            INSERT INTO auth\$users (
                display_name
                , login
                , pass
                , e_mail
                , phone
                , change_question
                , change_answer
            ) VALUES (
                ':display_name'
                , ':pass_hash'
                , ':e_mail'
                , ':phone'
                , ':change_question'
                , ':change_answer'
            );
SQL;
        $conn = Db::getConnection();
        $stmt = $conn->prepare($sql);
        if(!$stmt->execute()){
            throw new Exception(__METHOD__ . '/Что-то не так.');
        }

    }
}