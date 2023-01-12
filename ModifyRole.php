<?php
include "AdminHeader.php";
if(isset($_POST['update']))
{
    $roleID = $_POST['option'];
    DbOperations::insertIntoDB("DELETE FROM sectionsroles WHERE IDRole = $roleID");
    foreach($_POST['sections'] as $section)
    {
        $sectionName = $section;
        DbOperations::insertIntoDB("INSERT INTO sectionsroles (IDRole, IDSection) VALUES ($roleID, $sectionName)");
    }
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>Modify Role</title>
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
                        <form action="ModifyRole.php" class="form" method="post">
                            <h3 class="text-center text-info">Modify Role</h3>
                            <div class="form-group">
                                <label for="roleName" class="text-info">Role Name:</label><br>

                                    <select onchange="this.form.submit()" name = "option" class="form-select mx-auto" aria-label="Default select example">
                                        <?php
                                        $roles = DbOperations::getQueryTableResults("SELECT * FROM roles");
                                        foreach ($roles as $role)
                                        {
                                            $ID = $role[0];
                                            $name = $role[1];
                                            ?>
                                            <option <?php if(isset($_POST['option']) && $_POST['option'] == $ID) echo "selected"; ?> value="<?php echo $ID?>" ><?php echo $name?></option>";
                                            <?php
                                        }
                                        ?>
                                    </select>

                            </div>
                            <div class="form-group">
                                <label class="text-info">Select Sections:</label><br>
                                <?php
                                if(isset($_POST['option']))
                                {
                                    $role = $_POST['option'];
                                    $checkedSections = DbOperations::getQueryTableResults("SELECT IDSection FROM sectionsroles WHERE IDRole = $role");
                                }
                                $sections = DbOperations::getQueryTableResults("SELECT * FROM sections");
                                foreach($sections as $section)
                                {
                                    ?>
                                    <input <?php if(in_array($section[0], array_column($checkedSections, 'IDSection'))) echo "checked"?> type='checkbox' name='sections[]' value="<?php echo $section[0]?>"> <?php echo $section[1]?><br>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="update" class="btn btn-info btn-md" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>