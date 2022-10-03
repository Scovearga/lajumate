<?php

class Product
{
    private string $name;
    private $price;
    private $quantity;
    private $category;

    //region Constructor/Destructor
    public function __construct($name, $price, $quantity, $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->category = $category;
    }
    public function __destruct()
    {

    }
    //endregion
    //region GETTERS/SETTERS
    public function getName()
    {
        return $this->name;
    }
    public function setName($nume)
    {
        $this->name = $nume;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function setPrice($price)
    {
        $this->price = $price;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function getCategory()
    {
        return $this->category;
    }
    public function setCategory($category)
    {
        $this->category = $category;
    }
    //endregion
    //region Functions
    public function writeInFile()
    {
        $fisier = fopen("inventory", "a+");
        $text = $this->name . " " . $this->price . " " . $this->quantity . " " . $this->category .  " ";
        fwrite($fisier, $text);
    }
    public function readFromFile()
    {
        $fisier = fopen("inventory", "r");

    }
    //endregion
}