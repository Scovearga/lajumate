<?php
include "GetProductsFromDB.php";
include 'ShopHeader.php';
$foods = GetProductsFromDB::getAllFoodsFromDB();
$toys = GetProductsFromDB::getAllToysFromDB();
$electronics = GetProductsFromDB::getAllElectronicsFromDB();
$products = array_merge($foods, $toys, $electronics);
$numberOfProducts = sizeof($foods) + sizeof($toys) + sizeof($electronics);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="ShopStyle.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php
    for($i = 0; $i < $numberOfProducts; ++$i)
    {
        if($i % 4 == 0)
        {
            echo "<div class='row'>";
        }
    ?>
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="LINK CATRE PAGINA PRODUS">
                        <img class="pic-1" src="<?php echo $products[$i]["image"]?>">
                    </a>
                    <ul class="social">
                        <li><a href="LINK CATRE PAGINA PRODUS" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                        <form action='Cart.php' method='post'><input value='Add to cart' name = '<?php if($i <= sizeof($foods)) echo 'F '?> $IDaux' type='submit' class='btn btn-sm btn-primary btn-block'></form>
                        <li><a href="Cart.php" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#"><?php echo $products[$i]["Name"]?></a></h3>
                    <div class="price"><?php echo $products[$i]["Price"]?> lei
                    </div>
                    <a class="add-to-cart" href="">+ Add To Cart</a>
                </div>
            </div>
        </div>
    <?php
        if($i % 4 == 3)
        {
            echo "</div>";
        }
    }
    ?>

</body>
</html>
