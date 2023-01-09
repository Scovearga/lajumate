<?php
session_start();
require_once 'DbOperations.php';
require_once '../Classes/Product.php';
require_once '../Classes/Electronics.php';
require_once '../Classes/Foods.php';
require_once '../Classes/Toys.php';

if(!isset($_GET['quantity']))
{
    $PostFromPrevious = array_keys($_POST);
    $PostFromPreviousExploded = explode("_", $PostFromPrevious[0]);
    $productType = $PostFromPreviousExploded[0];
    $ID = $PostFromPreviousExploded[1];
}

if (!isset($_SESSION['products']))
{
    $_SESSION['products'] = array();
}

if(!isset($_SESSION['numberOfProducts']))
{
    $_SESSION['numberOfProducts'] = 0;
}

if(!isset($_GET['quantity']))
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
            $_SESSION['numberOfProducts']++;
            array_push($_SESSION['products'], $name);
            array_push($_SESSION['products'], $ID);
            array_push($_SESSION['products'], $price);
            array_push($_SESSION['products'], $image);
            array_push($_SESSION['products'], $quantity);
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
            $_SESSION['numberOfProducts']++;
            array_push($_SESSION['products'], $name);
            array_push($_SESSION['products'], $ID);
            array_push($_SESSION['products'], $price);
            array_push($_SESSION['products'], $image);
            array_push($_SESSION['products'], $quantity);
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
            $_SESSION['numberOfProducts']++;
            array_push($_SESSION['products'], $name);
            array_push($_SESSION['products'], $ID);
            array_push($_SESSION['products'], $price);
            array_push($_SESSION['products'], $image);
            array_push($_SESSION['products'], $quantity);
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
                <div class="px-lg-5 mr-lg-5" id="produc">PRODUCTS</div>
                <div class="px-lg-5 ml-lg-5" id="prc">PRICE</div>
                <div class="px-lg-5 ml-lg-1" id="quantity">QUANTITY</div>
                <div class="px-lg-5 ml-lg-3" id="total">TOTAL</div>
            </div>
            <?php
                for($i = 0; $i < $_SESSION['numberOfProducts']; ++$i)
                {
            ?>
            <div class="d-flex flex-row justify-content-between align-items-center pt-lg-4 pt-2 pb-3 border-bottom mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="<?php echo $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 3]?>" width="150" height="150" alt="" id="image"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6><?php echo $_SESSION['products'][$i * $_SESSION['numberOfProducts']]?></h6></div>
                        <div >Art. ID:<span class="pl-2"><?php echo $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 1]?></span></div>
                    </div>
                </div>
                <div style="margin-left: 55px" class="pl-md-0 pl-1"><b><?php echo $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 2]?> lei</b></div>
                <div class="pl-md-0 pl-2">
                    <form style="margin-top: 20px" action="Cart.php" method="get">
                        <input type="number" id="quantity" name="quantity" min="0" max="<?php echo $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 4]?>" step="1" value="<?php if(!isset($_GET['quantity'])) echo 1; else echo $_GET['quantity'];?>">
                        <input type="submit" value="Submit">
                    </form>
                </div>
                <div class="pl-md-0 pl-1"><b><?php if(isset($_GET['quantity'])) echo $_GET['quantity'] * $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 2];
                else echo $_SESSION['products'][$i * $_SESSION['numberOfProducts'] + 2]?> lei</b></div>
                <div class="close">&times;</div>
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
                    <b class="pl-md-4">SUBTOTAL<span class="pl-md-4">$61.78</span></b>
                </div>
                <div>
                    <button class="btn btn-sm bg-dark text-white px-lg-5 px-3">CONTINUE</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>