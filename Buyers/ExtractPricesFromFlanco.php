<?php
function getPriceFromFlanco($productName, $color)
{
    strtolower($productName);
    $productName = str_replace(' ', '-',$productName);
    $link = $productName . $color . '.html';
    $url   = "https://www.flanco.ro/" . $link;
    var_dump($url);
    $html  = file_get_contents($url);
    if($html == false)
        return -1;
    $seek  = '<span class="special-price"><span class="price">';
    $end   = strpos($html, $seek) + strlen($seek);
    $price = substr($html, $end, strpos($html, ',', $end) - $end);
    return $price;
}
