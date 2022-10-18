<?php

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
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
        $name = $this->getName();
        $price = $this->getPrice();
        $quantity = $this->getQuantity();
        $category = $this->getCategory();
        $expiryDate = $this->getExpiryDate();
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
        $command = $conn->prepare("INSERT INTO foods (Name, Price, Quantity, Category, ExpiryDate) 
                VALUES ('$name', '$price', '$quantity', '$category', '$expiryDate')");
        $command->execute();
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