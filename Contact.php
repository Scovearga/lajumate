<!doctype html>
<html lang="en">
<head>
    <title>Contact Us</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id="register">
    <h3 class="text-center text-white pt-5">Contact US</h3>
    <div class="container">
        <div id="register-row" class="row justify-content-center align-items-center">
            <div id="register-column" class="col-md-6">
                <div id="register-box" class="col-md-12">
                    <form id="register" class="form" method="post">
                        <h3 class="text-center text-info">Contact Us</h3>
                        <div class="form-group">
                            <label for="email" class="text-info">E-mail:</label><br>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mesaj" class="text-info">Mesaj:</label><br>
                            <textarea id="mesaj" name="mesaj" rows="10" cols="67"></textarea>
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
            $mail->Subject = "Mesaj Primit";
            $continutMail = '<h3> Am primit cu succes mesajul dumneavoastra!</h3>';
            $mail->Body = $continutMail;
//
//            $mail->send();
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
//            $continutMail = '<h3> Codul de confirmare al contului este: ' . $codConfirmare . '</h3>';
//
//            $mail->Body = $continutMail;
            $mail->send();

            $mail2 = new PHPMailer(1);
            $mail2->isSMTP();
            $mail2->Host = "smtp.gmail.com";
            $mail2->SMTPAuth = true;
            $mail2->Username = "heroku.lajumate@gmail.com";
            $mail2->Password = "kejfuoabqoacvuua";
            $mail2->SMTPSecure = "ssl";
            $mail2->Port = 465;
            $mail2->setFrom("heroku.lajumate@gmail.com", "La Jumate");
            $email = 'andreivirgil@hotmail.com';
            $mail2->addAddress($email);

            $mail2->isHTML(true);
            $mail2->Subject = "Un client a trimis un mesaj";
            $continutMail = '<h3>Clientul cu mail-ul ' . $_POST["email"] . ' a trimis prin formularul de contact urmatorul mesaj: </h3>' . '<p>' . htmlspecialchars($_POST['mesaj']) . '</p>';
            $mail2->Body = $continutMail;

            $mail2->send();
        }
        catch(Exception $e)
        {
            echo "Eroare!\n";
            echo "{$mail->ErrorInfo}";
        }
        header("Location: Login.php");
}
?>

