<?php
include 'AdminHeader.php';
require_once 'Classes/Product.php';
require_once 'Classes/Toys.php';
require_once 'Classes/Electronics.php';
require_once 'Classes/Foods.php';
$foods = array();
$toys = array();
$electronics = array();
$fisier = fopen("Files/inventory", "r");
//region DeleteProductFromDB
$DeleteProduct = array_keys($_POST);
if(sizeof($DeleteProduct) != 0)
{
    $DeleteProductExploded = explode("_", $DeleteProduct[0]);
    $productType = $DeleteProductExploded[0];
    $ID = $DeleteProductExploded[1];
    switch ($productType)
    {
        case "F":
        {
            Singleton::insertIntoDB("DELETE FROM foods WHERE ID='$ID'");
            break;
        }
        case "T":
        {
            Singleton::insertIntoDB("DELETE FROM toys WHERE ID='$ID'");
            break;
        }
        case "E":
        {
            Singleton::insertIntoDB("DELETE FROM electronics WHERE ID='$ID'");
            break;
        }
    }
}
//endregion
//region ReadFromFile
//if($fisier)
//{
//    while(($line = fgets($fisier)) != false)
//    {
//        $linieExploded = explode(" ", $line);
//        switch ($linieExploded[0])
//        {
//            case '1':
//            {
//                //$name, $price, $quantity, $expiryDate, $foodType
//                if ($linieExploded[4] == "Neperisabile")
//                    $foodType = 1;
//                else
//                    $foodType = 0;
//                $newFood = new Foods($linieExploded[1], $linieExploded[2], $linieExploded[3], $linieExploded[5], $foodType);
//                array_push($foods, $newFood);
//                break;
//            }
//            case '2':
//            {
//                //$name, $price, $quantity, $category, $series, $age
//                $newToy = new Toys($linieExploded[1], $linieExploded[2], $linieExploded[3], $linieExploded[4], $linieExploded[5], $linieExploded[6]);
//                array_push($toys, $newToy);
//                break;
//            }
//            case '3':
//            {
//                //$name, $price, $quantity, $category, $producer, $powerConsumption, $color
//                $newElectronic = new Electronics($linieExploded[1], $linieExploded[2], $linieExploded[3], $linieExploded[4], $linieExploded[5], $linieExploded[6], $linieExploded[7]);
//                array_push($electronics, $newElectronic);
//                break;
//            }
//        }
//    }
//}
//endregion
// region ReadFromDB

$foodsFromDB = Singleton::getQueryTableResults("SELECT * FROM foods");
foreach ($foodsFromDB as $food)
{
    $foodType = 1;
    if($food["Category"] == "Perisabile")
    {
        $foodType = 0;
    }
    $newFood = new Foods($food["ID"], $food["Name"], $food["Price"], $food["Quantity"], $food["ExpiryDate"], $foodType);
    array_push($foods, $newFood);
}

//read Electronics:
$ElectronicsFromDB = Singleton::getQueryTableResults("SELECT * FROM electronics");
foreach ($ElectronicsFromDB as $electronic)
{
    $newElectronic = new Electronics($electronic["ID"], $electronic["Name"], $electronic["Price"], $electronic["Quantity"], $electronic["Category"], $electronic["Producer"], $electronic["PowerConsumption"], $electronic["Color"]);
    array_push($electronics, $newElectronic);
}
//read Toys:
$ToysFromDB = Singleton::getQueryTableResults("SELECT * FROM toys");
foreach ($ToysFromDB as $toy)
{
    $newToy = new Toys($toy["ID"], $toy["Name"], $toy["Price"], $toy["Quantity"], $toy["Category"], $toy["Series"], $toy["Age"]);
    array_push($toys, $newToy);
}
// endregion
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Admin</title>
</head>
<body>
<div id="fullscreen_bg" class="fullscreen_bg"/>
    <div class="container">
        <div class="row">
            <div class="col-md-13 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel panel-primary">

                        <h3 class="text-center">
                            Inventory</h3>

                        <div class="panel-body">


                            <table class="table table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Category</th>
                                    <th>Expiry Date</th>
                                    <th>Series</th>
                                    <th>Age</th>
                                    <th>Producer</th>
                                    <th>Power</th>
                                    <th>Color</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    foreach ($foods as $oneFood)
                                    {
                                        echo "<tr>";
                                        $aux = $oneFood->getID();
                                        echo "<td>$aux</td>";
                                        $aux = $oneFood->getName();
                                        echo "<td>$aux</td>";
                                        $aux = $oneFood->getPrice();
                                        echo "<td>$aux</td>";
                                        $aux = $oneFood->getQuantity();
                                        echo "<td>$aux</td>";
                                        $aux = $oneFood->getCategory();
                                        echo "<td>$aux</td>";
                                        $aux = $oneFood->getExpiryDate();
                                        echo "<td>$aux</td>";
                                        $aux = '-';
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        $IDaux = $oneFood->getID();
                                        echo "<td><form action='UpdateProduct.php' method='post'><input value='Update' name = 'F $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                        echo "<td><form method='post'><input value='Delete' name = 'F $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                    }
                                    foreach ($toys as $toy)
                                    {
                                        echo "<tr>";
                                        $aux = $toy->getID();
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getName();
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getPrice();
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getQuantity();
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getCategory();
                                        echo "<td>$aux</td>";
                                        $aux = '-';
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getSeries();
                                        echo "<td>$aux</td>";
                                        $aux = $toy->getAge();
                                        echo "<td>$aux</td>";
                                        $aux = '-';
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        $IDaux = $toy->getID();
                                        echo "<td><form action='UpdateProduct.php' method='post'><input value='Update' name = 'T $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                        echo "<td><form method='post'><input value='Delete' name = 'T $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                    }
                                    foreach ($electronics as $electronic)
                                    {
                                        echo "<tr>";
                                        $aux = $electronic->getID();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getName();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getPrice();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getQuantity();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getCategory();
                                        echo "<td>$aux</td>";
                                        $aux = '-';
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getProducer();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getPowerConsumption();
                                        echo "<td>$aux</td>";
                                        $aux = $electronic->getColor();
                                        echo "<td>$aux</td>";
                                        $IDaux = $electronic->getID();
                                        echo "<td><form action='UpdateProduct.php' method='post'><input value='Update' name = 'F $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                        echo "<td><form method='post'><input value='Delete' name = 'E $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form></td>";
                                    }
                                ?>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</table>
<form action="AddNewItem.php" method="post">
        <input type="submit" name="submit" class="btn btn-sm btn-primary btn-block" value="Add new Item">
</form>
<br>
<form <?php if($_SESSION['userType'] == 1) echo "hidden"?> action="RegisterUsersByAdmin.php">
        <input type="submit" name="submit" class="btn btn-sm btn-primary btn-block" value="Register new User">
</form>
</body>
</html>

<?php

if(isset($_POST['option']))
{
    $option = $_POST['option'];
    $_SESSION['productType'] = $option;
    $newLocation = "AddNewItem.php";
    die();
    //header("Location: AddNewItem.php", false);
}
?>