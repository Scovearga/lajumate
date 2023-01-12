<!doctype html>
<html lang="en">
<head>
    <title>Activate Account</title>
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
                        <h3 class="text-center text-info">Activate account</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">E-mail:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="generatedCode" class="text-info">Code:</label><br>
                            <input type="text" name="generatedCode" id="generatedCode" class="form-control">
                        </div>
                        <div class="form-group">
                            <input href="Login.php" type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
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
require_once 'Classes/DbOperations.php';
require_once "Classes/UsersManipulation.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

session_start();
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
    return DbOperations::getQueryTableResults("SELECT * from users");
}

function addUserToDB($name, $pass)
{
    $pass = password_hash($pass);
    DbOperations::insertIntoDB("INSERT INTO `users` (`Name`, `Password`, `IDRole`) VALUES ('$name', '$pass', 4);");
}

function isUserInDB($name)
{
    $nr = DbOperations::numQueryResults("SELECT * from users WHERE Name='$name'");
    if($nr > 0)
    {
        return 1;
    }
    return 0;
}

if(isset($_POST['submit']))
{
    $value = 1;
    $emailQuery = $_POST['email'];
    $usernameQuery = $_POST['username'];
    $generatedCode = $_POST['generatedCode'];
    if(DbOperations::numQueryResults("SELECT * FROM users WHERE Email = '$emailQuery' AND generatedCode = '$generatedCode'") == 1)
    {
        DbOperations::insertIntoDB("UPDATE users SET isVerified = 1 WHERE Email = '$emailQuery' AND generatedCode = '$generatedCode';");
        try
        {
            $mail = new PHPMailer(1);
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "heroku.lajumate@gmail.com";
            $mail->Password = "kejfuoabqoacvuua";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;
            $mail->setFrom("heroku.lajumate@gmail.com", "La Jumate");
            $email = $_POST["email"];
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Cont creat";
            $continutMail = '<h3> Contul a fost confirmat cu succes!</h3>';
            //var_dump($continutMail);
            $mail->Body = $continutMail;

            $mail->send();
//            $mail = new PHPMailer(1);
//            $mail->isSMTP();
//            $mail->Host = "smtp.gmail.com";
//            $mail->SMTPAuth = true;
//            $mail->Username = "lajumate27@gmail.com";
//            $mail->Password = "misxnotpvmuveyfo";
//            $mail->SMTPSecure = "ssl";
//            $mail->Port = 465;
//            $mail->setFrom("lajumate27@gmail.com", "La Jumate");
//            $email = $_POST["email"];
//            $mail->addAddress($email);
//
//            $mail->isHTML(true);
//            $mail->Subject = "Cont creat";
//            $continutMail = '<h3> Contul a fost confirmat cu succes! </h3>';
//            $mail->Body = $continutMail;
//
//            $mail->send();
        }

        catch(Exception $e)
        {
            echo "Eroare!\n";
            echo "{$mail->ErrorInfo}";
        }
        header("Location: Login.php");
    }
    else
    {
        echo '<script>alert("Try again! We could not verify your account!")</script>';
    }
}
?>

