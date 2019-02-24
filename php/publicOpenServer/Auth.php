<?php
require_once 'Db.php';

class Auth
{
    static function login()
    {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $pass = md5($pass);
        $conn = Db::getConnection();
        $stmt = $conn->prepare(<<<SQL
          SELECT count(1) as CNT from users WHERE login = :login and passHash = :passHash;
SQL
);
        $stmt->bindParam('login', $login);
        $stmt->bindParam('passHash', $pass);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if ($result['CNT'] !== 1) {
            $data = json_encode(array(
                'success' => false
            ));
            header('Content-Type:application/json');
            header('Content-Length: ' . strlen($data));
            echo  $data;
            exit(0);
        }
        self::saveSession($login);
    }

    protected static function saveSession($login)
    {
        $sid = md5(random_bytes(128));
        $expiriedAt = new DateTime();
        $expiriedAt->modify('+1 day');
        $expiriedAt = $expiriedAt->getTimestamp();
        $conn = Db::getConnection();
        $stmt = $conn->prepare(<<<SQL
          INSERT INTO sessions(
            login, sess_id, expired_at
          ) VALUES (
            :login, :sess_id, :expired_at
          )
SQL
);
        $stmt->bindParam('login', $login, PDO::PARAM_STR);
        $stmt->bindParam('sess_id', $sid, PDO::PARAM_STR);
        $stmt->bindParam('expired_at', $expiriedAt,PDO::PARAM_INT);
        $result = $stmt->execute();
        setcookie('login', $login);
        setcookie('sid', $sid);
        if ($result['CNT'] !== 1) {
            $data = json_encode(array(
                'success' => true,
                'result' => $sid
            ));
            header('Content-Type:application/json');
            header('Content-Length: ' . strlen($data));
            die();
        }
    }
}