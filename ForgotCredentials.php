<!doctype html>
<html lang="en">
<head>
    <title>Forgot Password</title>
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
                            <label for="email" class="text-info">E-mail:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <input href="" type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
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

if(isset($_POST['submit']))
{
    $emailFromUser = $_POST['email'];
    $usernameFromUser = $_POST['username'];
    //$users = getUsersFromFile();
    //$users = getUsersFromDB();
    if(UsersManipulation::isUserInDBWithEmail($usernameFromUser, $emailFromUser) == 0)
    {
        echo '<script>alert("There is no user with this email or username!")</script>';
    }
    else
    {
        $accountDetails = DbOperations::getQueryTableResults("SELECT * from users WHERE Name='$usernameFromUser' AND Email = '$emailFromUser'");
        foreach($accountDetails as $account)
        {
            $passwordToSendToUser = $account["Password"];
        }
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
            $mail->Body = '<h3>Felicitari, contul a fost creat cu succes!</h3>';

            $mail->send();
        }

        catch(Exception $e)
        {
            echo "Eroare!\n";
            echo "{$mail->ErrorInfo}";
        }

        header("Location: Login.php");
    }
}
?>

