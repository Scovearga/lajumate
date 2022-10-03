<?php
session_start();
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
                                Add New Item</h3>
                            <form class="form form-signup" role="form">
                                <div class="form-group">
                                    <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span>
                            </span>
                                        <input name="name" type="text" class="form-control" value="" placeholder="Product name"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                                        <input name="quantity" type="Text" class="form-control" value="" placeholder="Quantity" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span>
                                        <input name="price" type="Text" class="form-control" value="" placeholder="Price"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-pushpin"></span></span>
                                        <input name="category" type="Text" class="form-control" value="" placeholder="Category" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Foods') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span></span>
                                        <input name="expiryDate" type="Text" class="form-control" value="" placeholder="Expiry date" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Toys') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                                        <input name="series" type="Text" class="form-control" value="" placeholder="Series" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Toys') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
                                        <input name="age" type="Text" class="form-control" value="" placeholder="Age" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Electronics') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-stats"></span></span>
                                        <input name = "producer" type="Text" class="form-control" value="" placeholder="Producer" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Electronics') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-flash"></span></span>
                                        <input name="power" type="Text" class="form-control" value="" placeholder="Power" />
                                    </div>
                                </div>
                                <div class="form-group" <?php if($_SESSION['productType'] != 'Electronics') echo 'hidden';?>>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-dashboard"></span></span>
                                        <input name="color" type="Text" class="form-control" value="" placeholder="Color" />
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="Add Item">
                        </div>
                    </div>
                </div>
            </div>
    </form>


    </div>
    </body>
    </html>

<?php
require_once 'Product.php';
require_once 'Toys.php';
require_once 'Electronics.php';
require_once 'Foods.php';
if(isset($_POST['submit']))
{
    if($_SESSION['productType'] == 'Foods')
    {
        if($_POST['expiryDate'] != 0)
        {
            $foodType = 0;
        }
        else
        {
            $foodType = 1;
        }
        $newFood = new Foods($_POST['name'], $_POST['price'], $_POST['quantity'], $_POST['expiryDate'], $foodType);
        $newFood->writeInFile();
    }
    elseif($_SESSION['productType'] == 'Toys')
    {
        $newToy = new Toys($_POST['name'], $_POST['price'], $_POST['quantity'], $_POST['category'], $_POST['series'], $_POST['age']);
        $newToy->writeInFile();
    }
    elseif($_SESSION['productType'] == 'Electronics')
    {
        $newElectronic = new Electronics($_POST['name'], $_POST['price'], $_POST['quantity'], $_POST['category'], $_POST['producer'], $_POST['powerConsumption'], $_POST['color']);
        $newElectronic->writeInFile();
    }

}
?>