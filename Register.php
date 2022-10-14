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
<div id="register">
    <h3 class="text-center text-white pt-5">Register form</h3>
    <div class="container">
        <div id="register-row" class="row justify-content-center align-items-center">
            <div id="register-column" class="col-md-6">
                <div id="register-box" class="col-md-12">
                    <form id="register" class="form" method="post">
                        <h3 class="text-center text-info">Register</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <input href="Admin.php" type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
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

function getUsersFromDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $command = $conn->prepare("SELECT * from users");
    $command->execute();
    $usersFromDB = $command->fetchAll();
    return $usersFromDB;
}

function addUserToDB($name, $pass)
{
    $pass = password_hash($pass);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $command = $conn->prepare("INSERT INTO `users` (`ID`, `Name`, `Password`, `IDRole`) VALUES (NULL, '$name', '$pass', 4);");
    $command->execute();
}

function isUserInDB($name)
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $command = $conn->prepare("SELECT * from users WHERE Name='$name'");
    $command->execute();
    $nr = $command->rowCount();
    if($nr > 0)
    {
        return 1;
    }
    return 0;
}

if(isset($_POST['submit']))
{
    //$users = getUsersFromFile();
    //$users = getUsersFromDB();
    if(isUserInDB($_POST['username']))
    {
       //array echo '<script>alert("A user with this username already exists")</script>';
    }
    else
    {
        addUserToDB($_POST['username'], $_POST['password']);
//        $file = fopen("users", "a+");
//        $user = $_POST['username'] . " " . $_POST['password'] . " 0\n";
//        fwrite($file, $user);
//        fclose($file);
        header("Location: Login.php");
    }
}
?>

