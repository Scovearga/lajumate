<?php
require_once "AdminHeader.php";

function getTotalUsers()
{
    return DbOperations::numQueryResults("SELECT DISTINCT ip FROM stats;");
}
function getWindowsUsers()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE browser LIKE '%Windows%';");
}

function getAndroidUsers()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE browser LIKE '%Android%';");
}
function getIosUsers()
{
    return DbOperations::numQueryResults("SELECT COUNT(distinct ip) FROM stats WHERE browser LIKE '%iPhone%';");
}
function getMacUsers()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE browser LIKE '%Macintosh%';");
}
function getShopViews()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE page LIKE '%Shop%';");
}
function getCartViews()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE page LIKE '%Cart%';");
}
function getSentOrderViews()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE page LIKE '%SentOrder%';");
}

echo "<h2>Numar Vizitatori: " . getTotalUsers() . "</h2>";
echo "<h2>Vizitatori de pe Windows: " . getWindowsUsers() . "</h2>";
echo "<h2>Vizitatori de pe Android: " . getAndroidUsers() . "</h2>";
echo "<h2>Vizitatori de pe IOS: " . getIosUsers() . "</h2>";
echo "<h2>Vizitatori de pe MAC: " . getMacUsers() . "</h2>";
echo "<h2>Vizitatori pagina Shop: " . getShopViews() . "</h2>";
echo "<h2>Vizitatori pagina Cart: " . getCartViews() . "</h2>";
echo "<h2>Vizitatori pagina Sent Order: " . getSentOrderViews() . "</h2>";

$dataPoints = array(
array("label"=>"Windows", "y"=> (100 * getWindowsUsers()) / getTotalUsers()),
array("label"=>"Android", "y"=> (100 * getAndroidUsers()) / getTotalUsers()),
array("label"=>"IOS", "y"=> (100 * getIosUsers()) / getTotalUsers()),
array("label"=>"MAC", "y"=> (100 * getMacUsers()) / getTotalUsers()),
)

?>
<!DOCTYPE HTML>
<html>
<head>
    <script>
        window.onload = function() {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title: {
                    text: "Procentaj Useri in functie de Platforma"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
