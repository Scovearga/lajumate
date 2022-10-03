<?php

class Electronics extends Product
{
    private $producer;
    private $powerConsumption;
    private $color;

    //region Constructor/Destructor
    public function __construct($name, $price, $quantity, $category, $producer, $powerConsumption, $color)
    {
        parent::__construct($name, $price, $quantity, $category);
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
    public function writeInFile()
    {
        parent::writeInFile();
        $fisier = fopen("inventory", "a+");
        $text = $this->producer . " " . $this->powerConsumption . " " . $this->color . " 0\n";
        fwrite($fisier, $text);
    }
    //endregion
}