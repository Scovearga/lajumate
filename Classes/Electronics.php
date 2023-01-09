<?php
require_once "DbOperations.php";
class Electronics extends Product
{
    private $producer;
    private $powerConsumption;
    private $color;

    //region Constructor/Destructor
    public function __construct($ID, $name, $price, $quantity, $category, $producer, $powerConsumption, $color)
    {
        parent::__construct($ID, $name, $price, $quantity, $category);
        $this->producer = $producer;
        $this->powerConsumption = $powerConsumption;
        $this->color = $color;
    }
    public function __destruct()
    {
        parent::__destruct();
    }
    //endregion
    //region GETTERS/SETTERS
    public function getProducer()
    {
        return $this->producer;
    }
    public function setProducer($producer)
    {
        $this->producer = $producer;
    }
    public function getPowerConsumption()
    {
        return $this->powerConsumption;
    }
    public function setPowerConsumption($powerConsumption)
    {
        $this->powerConsumption = $powerConsumption;
    }
    public function getColor()
    {
        return $this->color;
    }
    public function setColor($color)
    {
        $this->color = $color;
    }
    //endregion
    //region Functions
    public function writeInDB()
    {
        $name = $this->getName();
        $price = $this->getPrice();
        $quantity = $this->getQuantity();
        $category = $this->getCategory();
        $producer = $this->getProducer();
        $powerConsumption = $this->getPowerConsumption();
        $color = $this->getColor();
        DbOperations::insertIntoDB("INSERT INTO electronics (Name, Price, Quantity, Category, Producer, PowerConsumption, Color) 
                VALUES ('$name', $price, $quantity, '$category', '$producer', '$powerConsumption', '$color')");
    }
    public function writeInFile()
    {
        $type = 3 . " ";
        $fisier = fopen("inventory", "a+");
        fwrite($fisier, $type);
        parent::writeInFile();
        $text = $this->producer . " " . $this->powerConsumption . " " . $this->color . " 0\n";
        fwrite($fisier, $text);
    }
    //endregion
}