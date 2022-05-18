<?php

namespace Mvc\Models;

use Config\Model;
use PDO;

class LocationModel extends Model
{
    public function eachLocations()
    {
        $statement = $this->pdo->prepare('SELECT * FROM `house`');
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertHouse($houseCity, $nightPrice, $sqrtMeters, $description, $dpe, $ges, $nbOfRooms, $nbOfChambers)
    {
        $statement = $this->pdo->prepare('INSERT INTO `house` (`city`, `nightPrice`, `sqrtMeters`, `description`, `dpe`, `ges`, `nbOfRooms`, `nbOfChambers`) VALUES (:city, :nightPrice, :sqrtMeters, :description, :dpe, :ges, :nbOfRooms, :nbOfChambers)');
        $statement->execute([
            'city' => $houseCity,
            'nightPrice' => $nightPrice,
            'sqrtMeters' => $sqrtMeters,
            'description' => $description,
            'dpe' => $dpe,
            'ges' => $ges,
            'nbOfRooms'=> $nbOfRooms,
            'nbOfChambers' => $nbOfChambers,
        ]);
    }

    public function deleteHouse($houseID)
    {
        $statement = $this->pdo->prepare('DELETE FROM `house` WHERE id = :houseID');
        $statement->execute([
            'houseID' => $houseID
        ]);
    }
}