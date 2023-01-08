<?php
class Singleton
{
    protected static $instance;

    protected function __contstruct(){}

    public static function getInstance()
    {
        if(empty(self::$instance))
        {
            $servername = "eu-cdbr-west-03.cleardb.net";
            $username = "b2eb4acfda2994";
            $password = "03067a51";
            $dbname = "heroku_b696645800b15fd";
            self::$instance = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        }
        return self::$instance;
    }
}