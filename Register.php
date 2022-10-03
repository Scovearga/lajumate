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

if(isset($_POST['submit']))
{
    $users = getUsersFromFile();
    if(array_key_exists($_POST['username'], $users))
    {
       echo '<script>alert("A user with this username already exists")</script>';
    }
    else
    {
        $file = fopen("users", "a+");
        $user = $_POST['username'] . " " . $_POST['password'] . " 0\n";
        fwrite($file, $user);
        fclose($file);
        header("Location: Login.php");
    }
}
?>

