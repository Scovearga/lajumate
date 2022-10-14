<?php

class User
{
    private $ID;
    private $username;
    private $password;
    private $userType;

    //region CONSTRUCTOR/DESTRUCTOR
    public function __construct($username, $password, $userType)
    {
        $this->username = $username;
        $this->password = $userType;
        $this->password = $password;
    }
    public function __destruct()
    {

    }
    public function writeInDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $username = $this->username;
        $password = $this->password;
        $userType = $this->userType;
        $command = $conn->prepare("INSERT INTO users (Username, Password, UserType) 
                VALUES ('$username', '$password', '$userType')");
        $command->execute();
    }
    //endregion
    public function getUserType()
    {
        return $this->userType;
    }
}