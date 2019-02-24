<?php
require_once APP_ROOT . '/app/Db.php';

class Auth
{
    static function getHash($pass)
    {
        $result = sha1($pass);
        return $result;
    }

    /**
     * Авторизация по логин/пароль
     * @param $login
     * @param $pass
     * @return bool
     * @throws Exception
     */
    static function login($login, $pass)
    {
        $result = false;
        try {
            $passHash = self::getHash($pass);
            $sql = <<<SQL
SELECT t.id, t.login, t.display_name, t.is_admin
FROM auth\$users t
WHERE 
  t.login = :login
  AND 
  t.pass_hash = :hash 
SQL;
            $conn = Db::getConnection();
            $stmt = $conn->prepare($sql);
            $stmt->bindValue('login', $login);
            $stmt->bindValue('hash', $passHash);
            if (!$stmt->execute()) {
                throw new Exception(__METHOD__ . '/Что-то не так.');
            }
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (sizeof($data) !== 1) {
                return false;
            }
            $userData = $data[0];
            $userData['id'] = floatval($userData['id']);
            $userData['is_admin'] = $userData['is_admin'] === "1";
            $stmt->closeCursor();
            $sid = self::_createSession($userData['id']);
            $result = array_merge($userData, array(
                'sid' => $sid
            ));
        } catch (Exception $e) {
            \Helper\Log::addError($e, __METHOD__);
        }
        return $result;
    }
    public static function logout($sid){
        if (!self::_dropSession($sid)){
            return false;
        }
        return true;
    }

    /**
     * Создает сессию авторизации.
     * Сессия не зависит от метода вторизации.
     * @param $userId
     * @return string
     * @throws Exception
     */
    protected static function _createSession($userId)
    {
        try {
            $conn = Db::getConnection();
            $sql = 'insert into auth$sessions(USER_ID, SID)VALUES(:user_id, :sid)';
            $stmt = $conn->prepare($sql);

            $sid = sha1($userId . uniqid());
            // $loginedAt = (new  DateTime())->getTimestamp();
            $stmt->bindValue('user_id', $userId);
            $stmt->bindValue('sid', $sid);
            $conn->beginTransaction();
            $stmt->execute();
            $conn->commit();
        } catch (Exception $e) {
            \Helper\Log::addError($e, __METHOD__);
            return false;
        }
        return $sid;
    }

    /**
     * Удаляет сессию авторизации.
     * @param $sid
     * @return bool
     */
    protected static function _dropSession($sid)
    {
        try {
            $conn = Db::getConnection();
            $sql = 'delete from auth$sessions where SID = :sid';
            $stmt = $conn->prepare($sql);
            $stmt->bindValue('sid', $sid);
            $conn->beginTransaction();
            $stmt->execute();
            $conn->commit();
            return true;
        } catch (Exception $e) {
            \Helper\Log::addError($e, __METHOD__);
            return false;
        }
    }
}