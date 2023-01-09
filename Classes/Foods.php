<?php
require_once "Singleton.php";
require_once "DbOperations.php";
class Foods extends Product
{
    private $expiryDate;

    //region Constructor/Destructor
    public function __construct($ID, $name, $price, $quantity, $expiryDate, $foodType)
    {
        if ($foodType == 0)
        {
            $category = "Perisabile";
            $expiryDate = 0;
        }
        elseif ($foodType == 1)
        {
            $category = "Neperisabile";
        }
        parent::__construct($ID, $name, $price, $quantity, $category);
        $this->expiryDate = $expiryDate;
    }
    public function __destruct()
    {
        parent::__destruct();
    }
    //endregion
    //region GETTERS/SETTERS
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;
    }
    //endregion
    //region Functions
    public function writeInDB()
    {
        $name = $this->getName();
        $price = $this->getPrice();
        $quantity = $this->getQuantity();
        $category = $this->getCategory();
        $expiryDate = $this->getExpiryDate();
        DbOperations::insertIntoDB("INSERT INTO foods (Name, Price, Quantity, Category, ExpiryDate) 
                VALUES ('$name', '$price', '$quantity', '$category', $expiryDate)");
    }
    public function writeInFile()
    {
        $type = 1 . " ";
        $fisier = fopen("inventory", "a+");
        fwrite($fisier, $type);
        parent::writeInFile();
        $text = $this->expiryDate . " 0\n";
        fwrite($fisier, $text);
    }
    //endregion
}