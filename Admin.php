<?php
session_start();?>
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
<form class="form-signin">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel panel-primary">

                        <h3 class="text-center">
                            Inventory</h3>

                        <div class="panel-body">


                            <table class="table table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Bill</th>

                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>Filling</td>
                                    <td>100</td>
                                    <td>40 LE</td>

                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                                </tr>
                                <tr>

                                    <td>Crown</td>
                                    <td>250</td>
                                    <td>150 LE</td>

                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                                </tr>
                                <tr>

                                    <td>braces</td>
                                    <td>30</td>
                                    <td>800 LE</td>

                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Update</a></td>
                                    <td><a href="http://www.jquery2dotnet.com" class="btn btn-sm btn-primary btn-block" role="button">Delete</a></td>
                                </tr>
                                </tbody>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</form>
</table>
<form method="post">
        <select name = "option" class="form-select mx-auto" aria-label="Default select example">
            <option value="Foods">Foods</option>
            <option value="Toys">Toys</option>
            <option value="Electronics">Electronics</option>
        </select>
        <input type="submit" name="submit" class="btn btn-sm btn-primary btn-block" value="Add new Item">
</form>
</body>
</html>

<?php
if(isset($_POST['option']))
{
    $option = $_POST['option'];
    $_SESSION['productType'] = $option;
    header("Location: AddNewItem.php");
    exit();
}
?>