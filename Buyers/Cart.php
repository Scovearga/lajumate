<?php
session_start();
require_once 'DbOperations.php';
require_once '../Classes/Product.php';
require_once '../Classes/Electronics.php';
require_once '../Classes/Foods.php';
require_once '../Classes/Toys.php';

if(!isset($_GET['quantity0']) && !isset($_GET['quantity1']) && !isset($_GET['quantity2']) && !isset($_GET['quantity3']) && !isset($_GET['quantity4']))
{
    $PostFromPrevious = array_keys($_POST);
    $PostFromPreviousExploded = explode("_", $PostFromPrevious[0]);
    $productType = $PostFromPreviousExploded[0];
    $ID = $PostFromPreviousExploded[1];
}

if (!isset($_SESSION['quantity']))
{
    $_SESSION['quantity'] = array();
}

if(isset($_GET['delete0']))
{
    array_splice($_SESSION['products'], 0, 5);
    array_splice($_SESSION['quantity'], 0, 1);
    $_SESSION['numberOfProducts']--;
}

if(isset($_GET['delete1']))
{
    array_splice($_SESSION['products'], 5, 5);
    array_splice($_SESSION['quantity'], 1, 1);
    $_SESSION['numberOfProducts']--;
}

if(isset($_GET['delete2']))
{
    array_splice($_SESSION['products'], 10, 5);
    array_splice($_SESSION['quantity'], 2, 1);
    $_SESSION['numberOfProducts']--;
}

if(isset($_GET['delete3']))
{
    array_splice($_SESSION['products'], 15, 5);
    array_splice($_SESSION['quantity'], 3, 1);
    $_SESSION['numberOfProducts']--;
}

if(isset($_GET['delete4']))
{
    array_splice($_SESSION['products'], 20, 5);
    array_splice($_SESSION['quantity'], 4, 1);
    $_SESSION['numberOfProducts']--;
}

var_dump($_GET);
var_dump($_SESSION);

if(isset($_GET['quantity0']))
{
   $_SESSION['quantity'][0] = $_GET['quantity0'];
}

elseif(isset($_GET['quantity1']))
{
    $_SESSION['quantity'][1] = $_GET['quantity1'];
}

elseif(isset($_GET['quantity2']))
{
    $_SESSION['quantity'][2] = $_GET['quantity2'];
}

elseif(isset($_GET['quantity3']))
{
    $_SESSION['quantity'][3] = $_GET['quantity3'];
}

elseif(isset($_GET['quantity4']))
{
    $_SESSION['quantity'][4] = $_GET['quantity4'];
}

if (!isset($_SESSION['products']))
{
    $_SESSION['products'] = array();
}

if(!isset($_SESSION['numberOfProducts']))
{
    $_SESSION['numberOfProducts'] = 0;
}

if(!isset($_GET['quantity0']) && !isset($_GET['quantity1']) && !isset($_GET['quantity2']) && !isset($_GET['quantity3']) && !isset($_GET['quantity4']))
{
    switch ($productType)
    {
        case "F":
        {
            $foodsFromDB = DbOperations::getQueryTableResults("SELECT * FROM foods WHERE ID = '$ID'");
            foreach ($foodsFromDB as $food)
            {
                $foodType = 1;
                if($food["Category"] == "Perisabile")
                {
                    $foodType = 0;
                }
                $newFood = new Foods($food["ID"], $food["Name"], $food["Price"], $food["Quantity"], $food["ExpiryDate"], $foodType, $food['image']);
            }
            $name = $newFood->getName();
            $price = $newFood->getPrice();
            $quantity = $newFood->getQuantity();
            $category = $newFood->getCategory();
            $expiryDate = $newFood->getExpiryDate();
            $image = $newFood->getImagePath();
            if(array_search($ID, $_SESSION['products']) == false)
            {
                $_SESSION['numberOfProducts']++;
                array_push($_SESSION['products'], $name);
                array_push($_SESSION['products'], $ID);
                array_push($_SESSION['products'], $price);
                array_push($_SESSION['products'], $image);
                array_push($_SESSION['products'], $quantity);
                array_push($_SESSION['quantity'], 1);
            }
            else
            {
                $poz = array_search($ID, $_SESSION['products']);
                $_SESSION['quantity'][floor($poz / 5)]++;
            }
            break;
        }
        case "T":
        {
            $ToysFromDB = DbOperations::getQueryTableResults("SELECT * FROM toys WHERE ID = '$ID'");
            foreach ($ToysFromDB as $toy)
            {
                $newToy = new Toys($toy["ID"], $toy["Name"], $toy["Price"], $toy["Quantity"], $toy["Category"], $toy["Series"], $toy["Age"], $toy['image']);
            }
            $name = $newToy->getName();
            $price = $newToy->getPrice();
            $quantity = $newToy->getQuantity();
            $category = $newToy->getCategory();
            $series = $newToy->getSeries();
            $age = $newToy->getAge();
            $image = $newToy->getImagePath();
            if(array_search($ID, $_SESSION['products']) == false)
            {
                $_SESSION['numberOfProducts']++;
                array_push($_SESSION['products'], $name);
                array_push($_SESSION['products'], $ID);
                array_push($_SESSION['products'], $price);
                array_push($_SESSION['products'], $image);
                array_push($_SESSION['products'], $quantity);
                array_push($_SESSION['quantity'], 1);
            }
            else
            {
                $poz = array_search($ID, $_SESSION['products']);
                $_SESSION['quantity'][floor($poz / 5)]++;
            }
            break;
        }
        case "E":
        {
            $ElectronicsFromDB = DbOperations::getQueryTableResults("SELECT * FROM electronics WHERE ID = '$ID'");
            foreach ($ElectronicsFromDB as $electronic)
            {
                $newElectronic = new Electronics($electronic["ID"], $electronic["Name"], $electronic["Price"], $electronic["Quantity"], $electronic["Category"], $electronic["Producer"], $electronic["PowerConsumption"], $electronic["Color"], $electronic['image']);
            }
            $name = $newElectronic->getName();
            $price = $newElectronic->getPrice();
            $quantity = $newElectronic->getQuantity();
            $category = $newElectronic->getCategory();
            $producer = $newElectronic->getProducer();
            $powerConsumption = $newElectronic->getPowerConsumption();
            $color = $newElectronic->getColor();
            $image = $newElectronic->getImagePath();
            if(array_search($ID, $_SESSION['products']) == false)
            {
                $_SESSION['numberOfProducts']++;
                array_push($_SESSION['products'], $name);
                array_push($_SESSION['products'], $ID);
                array_push($_SESSION['products'], $price);
                array_push($_SESSION['products'], $image);
                array_push($_SESSION['products'], $quantity);
                array_push($_SESSION['quantity'], 1);
            }
            else
            {
                $poz = array_search($ID, $_SESSION['products']);
                $_SESSION['quantity'][floor($poz / 5)]++;
            }
            break;
        }
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="CartStyle.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Shopping cart</title>
</head>
<body>
<div class="container bg-white rounded-top mt-5" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12 pt-3">
            <div class="d-flex">
                <div class="pt-1"><h4>La jumate</h4></div>
            </div>
            <div class="d-flex flex-column pt-4">
                <div><h5 class="text-uppercase font-weight-normal">shopping bag</h5></div>
                <div class="font-weight-normal"><?php echo $_SESSION['numberOfProducts']; ?> items</div>
            </div>
            <div class="d-flex flex-row px-lg-5 mx-lg-5 mobile" id="heading">
                <div class="px-lg-5 mr-lg-2" id="produc">PRODUCTS</div>
                <div class="px-lg-5 ml-lg-5" id="prc">PRICE</div>
                <div class="px-lg-5 ml-lg-1" id="quantity">QUANTITY</div>
                <div class="px-lg-5 ml-lg-4" id="total">TOTAL</div>
            </div>
            <?php
                for($i = 0; $i < $_SESSION['numberOfProducts']; ++$i)
                {
            ?>
            <div class="d-flex flex-row justify-content-between align-items-center pt-lg-4 pt-2 pb-3 border-bottom mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="<?php echo $_SESSION['products'][$i * 5 + 3 ]?>" width="150" height="150" alt="" id="image"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6><?php echo $_SESSION['products'][$i * 5]?></h6></div>
                        <div >Art. ID:<span class="pl-2"><?php echo $_SESSION['products'][$i * 5 + 1]?></span></div>
                    </div>
                </div>
                <div style="margin-left: 55px" class="pl-md-0 pl-1"><b><?php echo $_SESSION['products'][$i * 5 + 2]?> lei</b></div>
                <div class="pl-md-0 pl-2">
                    <form style="margin-top: 20px" action="Cart.php" method="get">
                        <input type="number" id="quantity<?php echo $i?>" name="quantity<?php echo $i?>" min="0" max="<?php echo $_SESSION['products'][$i * 5 + 4]?>" step="1" value="<?php echo $_SESSION['quantity'][$i] ?>">
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div class="pl-md-0 pl-1"><b><?php echo $_SESSION['quantity'][$i] * $_SESSION['products'][$i * 5 + 2]; ?> lei</b></div>
                <form style="margin-top: 20px" action="Cart.php" method="get">
                    <input type="submit" name="delete<?php echo $i?>" class="btn btn-sm btn-primary btn-block" value="Delete Item">
                </form>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<div class="container bg-light rounded-bottom py-4" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <form action="Shop.php">
                        <button class="btn btn-sm bg-light border border-dark">Back to shopping</button>
                    </form>
                </div>
                <div class="px-md-0 px-1" id="footer-font">
                    <b class="pl-md-4">SUBTOTAL<span class="pl-md-4">
                            <?php
                                $total = 0;
                                for($i = 0; $i < $_SESSION['numberOfProducts']; ++$i)
                                {
                                    $total += ($_SESSION['quantity'][$i] * $_SESSION['products'][$i * 5 + 2]);
                                }
                                $_SESSION['total'] = $total;
                                echo $total;
                            ?>lei</span></b>
                </div>
                <form action="SentOrder.php">
                    <button class="btn btn-sm bg-light border border-dark">Send Order</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>