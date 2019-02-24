<?php
class Db
{
    protected static $conn = null;

    /**
     * @return null|PDO
     */
    static function getConnection(){
        if(is_null(self::$conn)){
            self::$conn = new PDO('mysql:host=localhost;dbname=mysitedb', 'root', '');
        }
        return self::$conn;
    }
}