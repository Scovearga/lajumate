<?php
include "AdminHeader.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div id="register">
    <h3 class="text-center text-white pt-5">Register form</h3>
    <div class="container">
        <div id="register-row" class="row justify-content-center align-items-center">
            <div id="register-column" class="col-md-6">
                <div id="register-box" class="col-md-12">
                    <form id="register" class="form" method="post">
                        <h3 class="text-center text-info">Register</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Username:</label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password:</label><br>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <select name = "option" class="form-select mx-auto" aria-label="Default select example">
                                <?php
                                $roles = DbOperations::getQueryTableResults("SELECT * FROM roles");
                                foreach ($roles as $role)
                                {
                                    echo "<option value='$role[0]'>$role[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input href="Login.php" type="submit" name="submit" class="btn btn-info btn-md" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
function getUsersFromFile()
{
    $file = fopen("users", "r");
    $users = array();
    while(($line = fgets($file)) != false)
    {
        $user = explode(" ", $line);
        $users[$user[0]][0] = $user[1];
        $users[$user[0]][1] = $user[2];
    }
    fclose($file);
    return $users;
}

function isUserInDB($name)
{
    $nr = DbOperations::numQueryResults("SELECT * from users WHERE Name='$name'");
    if($nr > 0)
    {
        return 1;
    }
    return 0;
}

function addUserToDB($name, $pass, $userType)
{
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    DbOperations::insertIntoDB("INSERT INTO `users` (`Name`, `Password`, `IDRole`) VALUES ('$name', '$pass', '$userType');");
}

if(isset($_POST['submit']))
{
    //$users = getUsersFromFile();
    //$users = getUsersFromDB();
    if(isUserInDB($_POST['username']))
    {
        //php lista erori
    }
    else
    {
        //sa nu fie empty
        addUserToDB($_POST['username'], $_POST['password'], $_POST['option']);
    }
}
?>


