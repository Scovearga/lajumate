<?php
include "User.php";

class UsersManipulation
{
    public function isUserInDB($name)
    {
        $nr = DbOperations::numQueryResults("SELECT * from users WHERE Name='$name'");
        if($nr > 0)
        {
            return 1;
        }
        return 0;
    }

    public function addUserToDB($name, $pass, $userType)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        DbOperations::insertIntoDB("INSERT INTO `users` (`Name`, `Password`, `IDRole`) VALUES ('$name', '$pass', '$userType');");
    }
}