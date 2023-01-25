<?php

use model\Hiking;
use App\database\Database;
require_once 'Database.php';
include 'model/Hiking.php';

class HikingDAO
{
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->connection = $this->db->getConnection();
    }

    public function create(Hiking $hiking)
    {
        $query = 'INSERT INTO hiking (name, difficulty, distance, duration, height_difference, available) VALUES (:name, :difficulty, :distance, :duration, :height_difference, :available)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':name', $hiking->getName());
        $stmt->bindValue(':difficulty', $hiking->getDifficulty());
        $stmt->bindValue(':distance', $hiking->getDistance());
        $stmt->bindValue(':duration', $hiking->getDuration());
        $stmt->bindValue(':available', $hiking->getAvailability());
        $stmt->bindValue(':height_difference', $hiking->getHeightDifference());
        $stmt->execute();
    }

    public function read()
    {
        $query = "SELECT * FROM hiking";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(Hiking $hiking)
    {
        $query = "UPDATE hiking SET name = :name, difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference, available = :available WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':name', $hiking->getName());
        $stmt->bindValue(':difficulty', $hiking->getDifficulty());
        $stmt->bindValue(':distance', $hiking->getDistance());
        $stmt->bindValue(':duration', $hiking->getDuration());
        $stmt->bindValue(':available', $hiking->getAvailability());
        $stmt->bindValue(':height_difference', $hiking->getHeightDifference());
        $stmt->bindValue(':id', $hiking->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM hiking WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getByID($id)
    {
        $query = "SELECT * FROM hiking WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result =  $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $hiking = new Hiking();
        $hiking->setId($result['id']);
        $hiking->setName($result['name']);
        $hiking->setDifficulty($result['difficulty']);
        $hiking->setDistance($result['distance']);
        $hiking->setDuration($result['duration']);
        $hiking->setAvailability($result['available']);
        $hiking->setHeightDifference($result['height_difference']);
        return $hiking;
    }
}
