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
            $password = "123456";
            $dbname = "shop";
            self::$instance = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        }
        return self::$instance;
    }

    public static function insertIntoDB($commandText)
    {
        $conn = self::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
    }

    public static function getQueryTableResults($commandText)
    {
        $conn = self::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
        return $command->fetchAll();
    }

    public static function numQueryResults($commandText)
    {
        $conn = self::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
        return $command->rowCount();
    }
}