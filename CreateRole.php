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
                        <h3 class="text-center text-info">Create New Role</h3>
                        <div class="form-group">
                            <label for="roleName" class="text-info">Role Name:</label><br>
                            <input type="text" name="roleName" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-info">Select Sections:</label><br>
                                <?php
                                $directory = new DirectoryIterator(__DIR__);
                                foreach ($directory as $file)
                                {
                                    if($file->isFile())
                                    {
                                        if(
                                                $file->getFilename() != 'Error403.html' &&
                                                $file->getFilename() != 'Login.php' &&
                                                $file->getFilename() != 'AdminHeader.php' &&
                                                $file->getFilename() != 'Register.php')
                                        {
                                            $name = $file->getFilename();
                                            $nameExploded = explode(".", $name)[0];
                                            echo "<input type='checkbox' name='sections[]' value='$nameExploded'> $nameExploded<br>";
                                            $servername = "localhost";
                                            $username = "root";
                                            $password = "";
                                            $dbname = "shop";
                                            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
                                            $command = $conn->prepare("SELECT * FROM sections WHERE SectionName='$nameExploded'");
                                            $command->execute();
                                            if($command->rowCount() == 0)
                                            {
                                                $command = $conn->prepare("INSERT INTO sections (SectionName) VALUES ('$nameExploded')");
                                                $command->execute();
                                            }
                                        }
                                    }
                                }
                                ?>
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
if(isset($_POST['submit']))
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shop";
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $roleName = $_POST['roleName'];
    $command = $conn->prepare("INSERT INTO roles (RoleName) VALUES ('$roleName')");
    $command->execute();
    $command = $conn->prepare("SELECT ID from roles WHERE RoleName = '$roleName'");
    $command->execute();
    $roleIDAux = $command->fetchAll();
    $roleID = $roleIDAux[0]["ID"];
    foreach($_POST['sections'] as $section)
    {
        $sectionName = $section;
        $command = $conn->prepare("INSERT INTO sectionsroles (IDRole, IDSection) VALUES ('$roleID',(SELECT ID from sections WHERE SectionName='$sectionName'))");
        $command->execute();
    }
}