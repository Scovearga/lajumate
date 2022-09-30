<?php

class Toys extends Product
{
    private $series;
    private $age;

    //region Constructor/Destructor
    public function __construct($name, $price, $quantity, $category, $series, $age)
    {
        parent::__construct($name, $price, $quantity, $category);
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
}