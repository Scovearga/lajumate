<?php
session_start();
require_once 'Stats.php';

if($_SESSION['userType'] != 4)
{
    header("Location: ../Error403.html");
}

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require('../fpdf185/fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();

$pdf->SetFont('Arial','B',14);

$pdf->Cell(130 ,5,'La jumate',0,0);
$pdf->Cell(59 ,5,'INVOICE',0,1);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'BD. Regina Elisabeta',0,0);
$pdf->Cell(59 ,5,'',0,1);

$date = date('d/m/Y');

$pdf->Cell(130 ,5,'Bucuresti, Romania, 030018',0,0);
$pdf->Cell(25 ,5,'Date',0,0);
$pdf->Cell(34 ,5,$date,0,1);

$pdf->Cell(130 ,5,'Phone 0123456789',0,1);

DbOperations::insertIntoDB("INSERT INTO idComenzi(comanda) VALUES('comanda');");
$idComanda = DbOperations::numQueryResults("SELECT * FROM idComenzi");

$pdf->Cell(130 ,5,'Fax 1234567',0,0);
$pdf->Cell(25 ,5,'ID Comanda',0,0);
$pdf->Cell(34 ,5,$idComanda,0,1);

$pdf->Cell(189 ,10,'',0,1);

$pdf->Cell(189 ,10,'',0,1);

$pdf->SetFont('Arial','B',12);

$pdf->Cell(130 ,5,'Product',1,0);
$pdf->Cell(25 ,5,'Quantity',1,0);
$pdf->Cell(34 ,5,'Amount',1,1);

$pdf->SetFont('Arial','',12);

for($i = 0; $i < $_SESSION['numberOfProducts']; ++$i)
{
    $pdf->Cell(130 ,5, $_SESSION['products'][$i * 5],1,0);
    $pdf->Cell(25 ,5,  $_SESSION['quantity'][$i],1,0);
    $pdf->Cell(34 ,5,  $_SESSION['products'][$i * 5 + 2] * $_SESSION['quantity'][$i],1,1,'R');

    $newQuantity = (intval($_SESSION['products'][$i * 5 + 4])) - (intval($_SESSION['quantity']));
    $givenID = $_SESSION['products'][$i * 5 + 1];
    var_dump($newQuantity);
    DbOperations::insertIntoDB("UPDATE foods SET Quantity = $newQuantity WHERE ID = '$givenID'");
    DbOperations::insertIntoDB("UPDATE toys SET Quantity = $newQuantity WHERE ID = '$givenID'");
    DbOperations::insertIntoDB("UPDATE electronics SET Quantity = $newQuantity WHERE ID = '$givenID'");
}

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Subtotal',0,0);
$pdf->Cell(34 ,5,$_SESSION['total'] ,1,1,'R');

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Tva',0,0);
$pdf->Cell(34 ,5,'19%',1,1,'R');

$pdf->Cell(130 ,5,'',0,0);
$pdf->Cell(25 ,5,'Total Due',0,0);
$pdf->Cell(34 ,5,$_SESSION['total'],1,1,'R');

//$mail = new PHPMailer(1);
//$mail->isSMTP();
//$mail->Host = "smtp.gmail.com";
//$mail->SMTPAuth = true;
//$mail->Username = "lajumate27@gmail.com";
//$mail->Password = "misxnotpvmuveyfo";
//$mail->SMTPSecure = "ssl";
//$mail->Port = 465;
//$mail->setFrom("lajumate27@gmail.com", "La Jumate");
//$email = $_SESSION["emailUser"];
//$mail->addAddress($email);
//
//$pdfdoc = $pdf->Output('', 'S');
//
//$mail->addStringAttachment($pdfdoc, 'Factura.pdf');
//
//$mail->isHTML(true);
//$mail->Subject = "Factura comanda";
//$continutMail = 'Factura comenzii este atasata acestui mail';
//
//$mail->Body = $continutMail;
//
//$mail->send();

$mail = new PHPMailer(1);
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "heroku.lajumate@gmail.com";
$mail->Password = "kejfuoabqoacvuua";
$mail->SMTPSecure = "ssl";
$mail->Port = 465;
$mail->setFrom("heroku.lajumate@gmail.com", "La Jumate");
$email = $_SESSION["emailUser"];
$mail->addAddress($email);

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

