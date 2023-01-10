<?php
session_start();
var_dump($_SESSION);
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require('../fpdf185/fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'La jumate',0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'BD. Regina Elisabeta',0,0);
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Bucuresti, Romania, 030018',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,'13/01/2023',0,1);//end of line

$pdf->Cell(130 ,5,'Phone 0123456789',0,0);
$pdf->Cell(25 ,5,'Invoice #',0,0);
$pdf->Cell(34 ,5,'307',0,1);//end of line

$pdf->Cell(130 ,5,'Fax 1234567',0,0);
$pdf->Cell(25 ,5,'Customer ID',0,0);
$pdf->Cell(34 ,5,'51',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Product',1,0);
$pdf->Cell(25 ,5,'Quantity',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);//end of line

$pdf->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

for($i = 0; $i < $_SESSION['numberOfProducts']; ++$i)
{
    $pdf->Cell(130 ,5, $_SESSION['products'][$i * 5],1,0);
    $pdf->Cell(25 ,5,  $_SESSION['quantity'][$i],1,0);
    $pdf->Cell(34 ,5,  $_SESSION['products'][$i * 5 + 2] * $_SESSION['quantity'][$i],1,1,'R');//end of line
}

//summary
$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Subtotal',0,0);
$pdf->Cell(34 ,5,$_SESSION['total'] ,1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Tva',0,0);
$pdf->Cell(34 ,5,'19%',1,1,'R');//end of line

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(34 ,5,$_SESSION['total'],1,1,'R');//end of line

$mail = new PHPMailer(1);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "lajumate27@gmail.com";
$mail->Password = "misxnotpvmuveyfo";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->setFrom("lajumate27@gmail.com", "La Jumate");
var_dump($_SESSION);
$_SESSION["emailUser"] = "andreivirgil@hotmail.com";
$email = $_SESSION["emailUser"];
var_dump($email);
$mail->addAddress("andreivirgil@hotmail.com");

$pdfdoc = $pdf->Output('', 'S');

$mail->addStringAttachment($pdfdoc, 'Factura.pdf');

$mail->isHTML(true);
$mail->Subject = "Factura comanda";
$continutMail = 'Factura comenzii este atasata acestui mail';

$mail->Body = $continutMail;

$mail->send();

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sent Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<body>
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center">
        <p class="fs-3"> <span class="text-danger">Order was sent!</span></p>
        <a href="../Login.php" class="btn btn-primary">Log in Page</a>
    </div>
</div>
</body>
</html>

