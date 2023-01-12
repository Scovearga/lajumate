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
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE browser LIKE '%iPhone%';");
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

function getProductPageViews()
{
    return DbOperations::numQueryResults("SELECT distinct ip FROM stats WHERE page LIKE '%ProductPage%';");
}

$totalPageViews = getShopViews() + getCartViews() + getSentOrderViews();

$dataPoints = array(
array("label"=>"Windows", "y"=> (100 * getWindowsUsers()) / getTotalUsers()),
array("label"=>"Android", "y"=> (100 * getAndroidUsers()) / getTotalUsers()),
array("label"=>"IOS", "y"=> (100 * getIosUsers()) / getTotalUsers()),
array("label"=>"MAC", "y"=> (100 * getMacUsers()) / getTotalUsers()),
);

$dataPoints2 = array(
    array("label"=>"Pagina Shop", "y"=> (100 * getShopViews()) / $totalPageViews),
    array("label"=>"Pagina Cart", "y"=> (100 * getCartViews()) / $totalPageViews),
    array("label"=>"Pagina Sent Order", "y"=> (100 * getSentOrderViews()) / $totalPageViews),
    array("label"=>"Pagina Product", "y"=> (100 * getProductPageViews()) / $totalPageViews)
);

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
            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                title: {
                    text: "Procentaj Useri in functie de Paginile Accesate"
                },
                data: [{
                    type: "pie",
                    yValueFormatString: "#,##0.00\"%\"",
                    indexLabel: "{label} ({y})",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();
        }
    </script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<div id="chartContainer2" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
