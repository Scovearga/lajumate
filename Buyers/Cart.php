<?php
var_dump($_POST);
var_dump($_SESSION);
$PostFromPrevious = array_keys($_POST);
$PostFromPreviousExploded = explode("_", $PostFromPrevious[0]);
$productType = $PostFromPreviousExploded[0];
$ID = $PostFromPreviousExploded[1];

if (!isset($_SESSION['products']))
{
    $_SESSION['products'] = array();
}
var_dump($productType);
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
        array_push($_SESSION['products'], $newFood);
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
        array_push($_SESSION['products'], $newToy);
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
        array_push($_SESSION['products'], $price);
        array_push($_SESSION['products'], $image);
        array_push($_SESSION['products'], $name);
        break;
    }
}
var_dump($_SESSION);
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
                <div class="ml-auto p-2"><a href="#" class="text-dark text-decoration-none" id="mobile-font">LOGIN</a></div>
                <div class="p-2"><a href="#" class="text-dark text-decoration-none a" id="mobile-font">HELP</a></div>
            </div>
            <div class="d-flex flex-column pt-4">
                <div><h5 class="text-uppercase font-weight-normal">shopping bag</h5></div>
                <div class="font-weight-normal">2 items</div>
            </div>
            <div class="d-flex flex-row px-lg-5 mx-lg-5 mobile" id="heading">
                <div class="px-lg-5 mr-lg-5" id="produc">PRODUCTS</div>
                <div class="px-lg-5 ml-lg-5" id="prc">PRICE</div>
                <div class="px-lg-5 ml-lg-1" id="quantity">QUANTITY</div>
                <div class="px-lg-5 ml-lg-3" id="total">TOTAL</div>
            </div>
<!--            --><?php
//            for($i = 0; $i < count($_SESSION['products']); ++$i)
//            {
//                var_dump($_SESSION);
//            ?>
            <div class="d-flex flex-row justify-content-between align-items-center pt-lg-4 pt-2 pb-3 border-bottom mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" width="150" height="150" alt="" id="image"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6>COTTON T-SHIRT</h6></div>
                        <div >Art. ID:<span class="pl-2">091091001</span></div>
                    </div>
                </div>
                <div class="pl-md-0 pl-1"><b>$9.99</b></div>
                <div class="pl-md-0 pl-2">
                    <span class="fa fa-minus-square text-secondary"></span><span class="px-md-3 px-1">2</span><span class="fa fa-plus-square text-secondary"></span>
                </div>
                <div class="pl-md-0 pl-1"><b>$19.98</b></div>
                <div class="close">&times;</div>
            </div>
<!--            --><?php //echo "";
//            }
//            ?>
            <div class="d-flex flex-row justify-content-between align-items-center pt-4 pb-3 mobile">
                <div class="d-flex flex-row align-items-center">
                    <div><img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60" width="150" height="150" alt="" id="image"></div>
                    <div class="d-flex flex-column pl-md-3 pl-1">
                        <div><h6>WHITE T-SHIRT</h6></div>
                        <div >Art.No:<span class="pl-2">056289891</span></div>
                        <div>Color:<span class="pl-3">White</span></div>
                        <div>Size:<span class="pl-4"> XL</span></div>
                    </div>
                </div>
                <div class="pl-md-0 pl-1"><b>$20.9</b></div>
                <div class="pl-md-0 pl-2">
                    <span class="fa fa-minus-square text-secondary"></span><span class="px-md-3 px-1">2</span><span class="fa fa-plus-square text-secondary"></span>
                </div>
                <div class="pl-md-0 pl-1"><b>$41.8</b></div>
                <div class="close">&times;</div>
            </div>

        </div>
    </div>
</div>
<div class="container bg-light rounded-bottom py-4" id="zero-pad">
    <div class="row d-flex justify-content-center">
        <div class="col-lg-10 col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <button class="btn btn-sm bg-light border border-dark">GO BACK</button>
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