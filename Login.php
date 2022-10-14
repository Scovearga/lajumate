<!doctype html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id="login">
    <h3 class="text-center text-white pt-5">Login form</h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">
                    <form id="login" class="form" method="post">
                        <h3 class="text-center text-info">Login</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                        </div>
                        <div id="register-link" class="text-right">
                            <a href="Register.php" class="text-info">Register here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();
$_SESSION['userType'] = -2;
function getUsersFromFile()
{
    $file = fopen("users", "r");
    $users = array();
    while(($line = fgets($file)) != false)
    {
        $user = explode(" ", $line);
        $users[$user[0]][0] = $user[1];
        $users[$user[0]][1] = $user[2];
    }
    fclose($file);
    return $users;
}

function getUserType($usernameFromUser, $passwordFromUser)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $command = $conn->prepare("SELECT * FROM `users` WHERE Name = '$usernameFromUser'");
    $command->execute();
    $user = $command->fetchAll();
    $rows = $command->rowCount();
    if($rows == 0)
    {
        return -1;
    }
    elseif(password_verify($passwordFromUser, $user[0]['Password']))
    {
        return $user[0]["IDRole"];
    }
    return 0;
}

if(isset($_POST['submit']))
{
    //$users = getUsersFromFile();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = getUserType($username, $password);
    $_SESSION['userType'] = $userType;
    var_dump($_SESSION);
    switch($userType)
    {
        case -1:
        {
            //wrong name
            break;
        }
        case 0:
        {
            //wrong password;
            break;
        }
        case 4:
        {
            //redirect to shop page
            break;
        }
        default:
        {
            //$_SESSION['userType'] = 6;
            header("Location: Admin.php");
            break;
        }
    }
}

?>
