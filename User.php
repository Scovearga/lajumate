<?php

class User
{
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
    //endregion
    public function getUserType()
    {
        return $this->userType;
    }
}