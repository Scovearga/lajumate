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
        $username = $this->username;
        $password = $this->password;
        $userType = $this->userType;
        Singleton::insertIntoDB("INSERT INTO users (Username, Password, UserType) 
                VALUES ('$username', '$password', '$userType')");
    }
    //endregion
    public function getUserType()
    {
        return $this->userType;
    }
}