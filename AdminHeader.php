<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="AdminHeaderStyle.css">
    <script src="ScriptAdminHeader"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="tabs-to-dropdown">
    <div class="nav-wrapper d-flex align-items-center justify-content-between">
        <ul class="nav nav-pills d-none d-md-flex" id="pills-tab" role="tablist">
            <form style="margin-right: 10px" action="Admin.php">
                <li class="mr-xs nav-item" role="presentation">
                    <input type="submit" class="btn btn-info btn-md" value="Inventory">
                </li>
<!--                    <input type = "submit">-->
<!--                    <a class="nav-link" data-toggle="pill" href="Admin.php" role="tab" aria-controls="pills-product" aria-selected="false">Inventory</a>-->
<!--                </li>-->
            </form>
            <form style="margin-right: 10px" action="AddNewItem.php">
                <li class="nav-item" role="presentation">
                    <input type="submit" class="btn btn-info btn-md" value="Add New Item">
                </li>
            </form>
            <form action="RegisterUsersByAdmin.php">
                <li class="nav-item" role="presentation">
                    <input type="submit" class="btn btn-info btn-md" value="Register User">
                </li>
            </form>
        </ul>
    </div>

    </div>
</div>

</body>
</html>
<?php
