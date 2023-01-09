<?php
include "DbOperations.php";

class GetProductsFromDB
{
    public static function getAllFoodsFromDB()
    {
        return DbOperations::getQueryTableResults("SELECT Name, Price, image FROM foods WHERE Quantity > 0");
    }

    public static function getAllToysFromDB()
    {
        return DbOperations::getQueryTableResults("SELECT Name, Price, image FROM toys WHERE Quantity > 0");
    }

    public static function getAllElectronicsFromDB()
    {
        return DbOperations::getQueryTableResults("SELECT Name, Price, image FROM electronics WHERE Quantity > 0");
    }
}
