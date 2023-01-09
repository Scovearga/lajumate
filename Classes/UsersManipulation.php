<?php
include "User.php";

class UsersManipulation
{
    public static function isUserInDB($name)
    {
        $nr = DbOperations::numQueryResults("SELECT * from users WHERE Name='$name'");
        if($nr > 0)
        {
            return 1;
        }
        return 0;
    }

    public static function addUserToDB($name, $pass, $userType, $email)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        DbOperations::insertIntoDB("INSERT INTO `users` (`Name`, `Password`, `IDRole`, `Email`) VALUES ('$name', '$pass', '$userType', '$email');");
    }
}