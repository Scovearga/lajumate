<?php
function getPriceFromFlanco($productName, $color)
{
    $productName = strtolower($productName);
    $productName = str_replace(' ', '-',$productName);
    $link = $productName . $color . '.html';
    var_dump($link);
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
