<?php
require_once 'Classes/Product.php';
require_once 'Classes/Toys.php';
require_once 'Classes/Electronics.php';
require_once 'Classes/Foods.php';
$PostFromPrevious = array_keys($_POST);
$PostFromPreviousExploded = explode("_", $PostFromPrevious[0]);
//$_SESSION['productType'] = $PostFromPreviousExploded[0];
//$_SESSION['ID'] = $PostFromPreviousExploded[1];
$productType = $PostFromPreviousExploded[0];
$ID = $PostFromPreviousExploded[1];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";
$expiryDate = 0;
$age = 0;
$series = "none";
$producer = "none";
$powerConsumption = 0;
$color = "none";
if(isset($_POST['modifyProduct']))
{
    switch($productType)
    {
        case "F":
        {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $category = $_POST['category'];
            $expiryDate = $_POST['expiryDate'];
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $command = $conn->prepare("UPDATE foods SET Name='$name', Price=$price, Quantity=$quantity, Category='$category', ExpiryDate=$expiryDate
            WHERE ID='$ID'");
            $command->execute();
            $conn = null;
            break;
        }
        case "T":
        {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $series = $_POST['series'];
            $age = $_POST['age'];
            $category = $_POST['category'];
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $command = $conn->prepare("UPDATE toys SET Name='$name', Price=$price, Quantity=$quantity, Category='$category', Series='$series', Age='$age'
            WHERE ID='$ID'");

            $command->execute();
            $conn = null;
            break;
        }
        case "E":
        {
            $name = $_POST['name'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $producer = $_POST['producer'];
            $powerConsumption = $_POST['power'];
            $color = $_POST['color'];
            $category = $_POST['category'];
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
            $command = $conn->prepare("UPDATE electronics SET Name='$name', Price=$price, Quantity=$quantity, Category='$category', Producer='$producer', PowerConsumption='$powerConsumption', Color='$color'
            WHERE ID='$ID'");
            $command->execute();
            $conn = null;
            break;
        }
    }
}
switch ($productType)
{
    case "F":
    {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $command = $conn->prepare("SELECT * FROM foods WHERE ID = '$ID'");
        $command->execute();
        $foodsFromDB = $command->fetchAll();
        foreach ($foodsFromDB as $food)
        {
            $foodType = 1;
            if($food["Category"] == "Perisabile")
            {
                $foodType = 0;
            }
            $newFood = new Foods($food["ID"], $food["Name"], $food["Price"], $food["Quantity"], $food["ExpiryDate"], $foodType);
        }
        $name = $newFood->getName();
        $price = $newFood->getPrice();
        $quantity = $newFood->getQuantity();
        $category = $newFood->getCategory();
        $expiryDate = $newFood->getExpiryDate();
        $conn = null;
        break;
    }
    case "T":
    {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $command = $conn->prepare("SELECT * FROM toys WHERE ID = '$ID'");
        $command->execute();
        $ToysFromDB = $command->fetchAll();
        foreach ($ToysFromDB as $toy)
        {
            $newToy = new Toys($toy["ID"], $toy["Name"], $toy["Price"], $toy["Quantity"], $toy["Category"], $toy["Series"], $toy["Age"]);
        }
        $name = $newToy->getName();
        $price = $newToy->getPrice();
        $quantity = $newToy->getQuantity();
        $category = $newToy->getCategory();
        $series = $newToy->getSeries();
        $age = $newToy->getAge();
        $conn = null;
        break;
    }
    case "E":
    {
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $command = $conn->prepare("SELECT * FROM electronics WHERE ID = '$ID'");
        $command->execute();
        $ElectronicsFromDB = $command->fetchAll();
        foreach ($ElectronicsFromDB as $electronic)
        {
            $newElectronic = new Electronics($electronic["ID"], $electronic["Name"], $electronic["Price"], $electronic["Quantity"], $electronic["Category"], $electronic["Producer"], $electronic["PowerConsumption"], $electronic["Color"]);
        }
        $name = $newElectronic->getName();
        $price = $newElectronic->getPrice();
        $quantity = $newElectronic->getQuantity();
        $category = $newElectronic->getCategory();
        $producer = $newElectronic->getProducer();
        $powerConsumption = $newElectronic->getPowerConsumption();
        $color = $newElectronic->getColor();
        $conn = null;
        break;
    }
}

$conn = null;
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
        <title>Document</title>
    </head>
    <body>
    <div id="fullscreen_bg" class="fullscreen_bg"/>
    <form class="form-signin" method="post">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="text-center">
                                Edit Product</h3>
                            <form method="post" class="form form-signup" role="form">
                                <input type = "hidden" name = "<?php echo $productType . '_'. $ID?>">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                                        <input name="name" type="text" class="form-control" value="<?php echo $name?>"/>
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        <input name="quantity" type="Text" class="form-control" value="<?php echo $quantity?>" placeholder="Quantity"/>
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                        <input name="price" type="Text" class="form-control" value="<?php echo $price?>" placeholder="Price"/>
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-pushpin"></span></span>
                                        <input name="category" type="Text" class="form-control" <?php if($productType == "F") echo "readonly";?> value="<?php echo $category?>" placeholder="Category" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'F') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
                                        <input name="expiryDate" type="Text" class="form-control" value="<?php echo $expiryDate?>" placeholder="Expiry date" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'T') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                                        <input name="series" type="Text" class="form-control"<?php echo $series?> placeholder="Series" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'T') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
                                        <input name="age" type="Text" class="form-control" <?php echo $age?> placeholder="Age" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'E') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                                        <input name = "producer" type="Text" class="form-control" <?php echo $producer?> placeholder="Producer" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'E') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
                                        <input name="power" type="Text" class="form-control" <?php echo $powerConsumption?> placeholder="Power" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <div class="form-group" <?php if($productType != 'E') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
                                        <input name="color" type="Text" class="form-control" <?php echo $color?> placeholder="Color" />
                                        <span class="input-group-addon"><button class="glyphicon glyphicon-pencil"></button></span>
                                    </div>
                                </div>
                                <input type="submit" name="modifyProduct" class="btn btn-info btn-md" value="Update Item">
                                <a href="Admin.php" class="btn btn-info btn-md">Admin page</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </form>


    </div>
    </body>
    </html>
