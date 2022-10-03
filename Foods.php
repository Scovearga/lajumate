<?php

class Foods extends Product
{
    private $expiryDate;

    //region Constructor/Destructor
    public function __construct($name, $price, $quantity, $expiryDate, $foodType)
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
        parent::__construct($name, $price, $quantity, $category);
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
    public function writeInFile()
    {
        $type = 1;
        $fisier = fopen("inventory", "a+");
        fwrite($fisier, $type);
        parent::writeInFile();
        $text = $this->expiryDate . " 0\n";
        fwrite($fisier, $text);
    }
    //endregion
}