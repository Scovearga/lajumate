<?php
include "Singleton.php";
class DbOperations
{
    public static function insertInDB($table, $values, $numValues)
    {
        $conn = Singleton::getInstance();
        $counter = 0;
        foreach ($values as $value)
        {
            $counter++;
            if($counter % $numValues == 0)
            {
                $toadd = $toadd . $value . ") ";
                continue;
            }
            elseif ($counter % $numValues == 1)
            {
                $toadd = $toadd . "(" . $value . ", ";
                continue;
            }
            $toadd = $toadd . $value . ", ";
        }
        $command = $conn->prepare("INSERT INTO " . $table . " VALUES " . $toadd);
        $command->execute();
    }

    public static function insertIntoDB($commandText)
    {
        $conn = Singleton::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
    }

    public static function deleteInDB($table, $tableColumn, $value)
    {
        $conn = Singleton::getInstance();
        $command = $conn->prepare("DELETE FROM sectionsroles WHERE '$tableColumn' = $value");
        $command->execute();
    }

    public static function getQueryTableResults($commandText)
    {
        $conn = Singleton::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
        return $command->fetchAll();
    }

    public static function numQueryResults($commandText)
    {
        $conn = Singleton::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
        return $command->rowCount();
    }

    public static function updateTable($commandText)
    {
        $conn = Singleton::getInstance();
        $command = $conn->prepare($commandText);
        $command->execute();
    }
}