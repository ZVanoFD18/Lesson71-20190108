<?php

class Db
{
    protected static $schema= '';
    protected static $login= '';
    protected static $pass='';
    protected static $connection = null;
    protected static $dbVersion = null;
    static function setParams($schema, $login, $pass, $dbVersion){
        self::$schema = $schema;
        self::$login = $login;
        self::$pass = $pass;
        self::$dbVersion = $dbVersion;
    }

    /**
     * @return null|PDO
     * @throws Exception
     */
    static function getConnection($checkDb=true){
        if (is_null(self::$connection)){
            try {
                self::$connection = new PDO(self::$schema, self::$login, self::$pass);
                self::$connection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                if ($checkDb){
                    self::checkDb(self::$connection);
                }
            } catch (Exception $e){
                throw $e;
            }
        }
        return self::$connection;
    }

    /**
     * @param {PDO} $conn
     * @throws Exception
     */
    static function checkDb($conn){
        $sql = 'SELECT version, status FROM sys$db_info';
        $stmt = self::$connection->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (sizeof($result) !== 1){
            throw new Exception('Неверное количество записей в таблице "sys$db_info"');
        }
        if($result[0]->version != self::$dbVersion){
            throw new Exception('Неверна версия БД');
        }
        if($result[0]->status !== 'LOCK'){
            throw new Exception('БД в состоянии обновления');
        }
    }
}