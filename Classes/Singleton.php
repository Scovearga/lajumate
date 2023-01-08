<?php
class Singleton
{
    protected static $instance;

    protected function __contstruct(){}

    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop";
            self::$instance = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        }
        return self::$instance;
    }
}