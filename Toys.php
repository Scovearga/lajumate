<?php

class Toys extends Product
{
    private $series;
    private $age;

    //region Constructor/Destructor
    public function __construct($ID, $name, $price, $quantity, $category, $series, $age)
    {
        parent::__construct($ID, $name, $price, $quantity, $category);
        $this->series = $series;
        $this->age = $age;
    }
    public function __destruct()
    {
        parent::__destruct();
    }
    //endregion
    //region GETTERS/SETTERS
    public function getSeries()
    {
        return $this->series;
    }
    public function setSeries($series)
    {
        $this->series = $series;
    }
    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
    //endregion
    //region Functions
    public function writeInDB()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shop";
        $conn = new mysqli($servername, $username,$password, $dbname);
        $name = $this->getName();
        $price = $this->getPrice();
        $quantity = $this->getQuantity();
        $category = $this->getCategory();
        $series = $this->getSeries();
        $age = $this->getAge();
        $sql = "INSERT INTO toys (Name, Price, Quantity, Category, Series, Age) 
                VALUES ('$name', $price, $quantity, '$category', '$series', '$age')";
        if($conn->query($sql) == TRUE)
        {
            echo "<script> alert('New Item added');</script>";
        }
        else
        {
            //echo $conn->error;
            echo "<script> alert('An error has occured!');</script>";
        }
    }
    public function writeInFile()
    {
        $type = 2 . " ";
        $fisier = fopen("inventory", "a+");
        fwrite($fisier, $type);
        parent::writeInFile();
        $text = $this->series . " " . $this->age . " 0\n";
        fwrite($fisier, $text);
    }
    //endregion
}