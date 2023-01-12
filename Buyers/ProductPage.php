<?php
session_start();
require "ShopHeader.php";
require "../Classes/Product.php";
require "../Classes/Foods.php";
require "../Classes/Toys.php";
require "../Classes/Electronics.php";
require "ExtractPricesFromFlanco.php";
var_dump($_POST);

$PostFromPrevious = array_keys($_POST);
$PostFromPreviousExploded = explode("_", $PostFromPrevious[0]);
$productType = $PostFromPreviousExploded[0];
$ID = $PostFromPreviousExploded[1];

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
        break;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="AdminHeaderStyle.css" rel="stylesheet">
    <link href="ProductPageStyle.css" rel="stylesheet">
    <title>Product Page</title>
</head>
<body>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="<?php echo $image?>" width="250" /></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <a href="Shop.php" class="ml-1">Back</a> </div> <i class="fa fa-shopping-cart text-muted"></i>
                            </div>
                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">La jumate</span>
                                <h5 class="text-uppercase"><?php echo $name?></h5>
                                <div class="price d-flex flex-row align-items-center"> <span class="act-price"><?php echo $price?> lei</span>
                                    <div class="ml-2"> <small class="dis-price"><?php echo $price * 1.4?></small> <span>40% OFF</span> </div>
                                </div>
                            </div>
                            <p class="about">Pret Flanco: <?php
                                if(isset($color) and getPriceFromFlanco($name, $color) == -1)
                                    echo "Produsul nu exista la competitor";
                                else if(isset($color))
                                    echo getPriceFromFlanco($name, $color) . " lei";
                                else
                                    echo "Produsul nu exista la competitor"
                                ?></p>
                            <br><br><br><br><br><br><br><br><br><br><br><br>
                            <form action='Cart.php' method='post'>
                                <input value='Add to cart' name = "<?php echo $productType . "_" . $ID ?>" type='submit' class='btn btn-sm btn-primary btn-block'>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
