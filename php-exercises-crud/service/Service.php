<?php
require_once 'Helper.php';


class Service
{

    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->connection = $this->db->getConnection();
    }

    public function readClients()
    {
        $query = "SELECT * FROM clients";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClientByName($lastName)
    {
        $query = "SELECT * FROM clients WHERE lastName = :lastName";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }


    public function getClientById($id)
    {
        $query = "SELECT * FROM clients WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }

    public function readShowTypes()
    {
        $query = "SELECT * FROM showtypes";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getShowByName($title)
    {
        $query = "SELECT * FROM shows WHERE title = :title";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }


    public function read20Clients()
    {
        $query = "SELECT * FROM clients LIMIT 20";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readClientsWithCard()
    {
        $query = "SELECT * FROM clients WHERE card = 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readClientsStartsM()
    {
        $query = "SELECT firstName, lastName 
                    FROM clients 
                    WHERE lastName LIKE 'M%'
                    ORDER BY lastName";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readShows()
    {
        $query = "SELECT * FROM shows ORDER BY title";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createClient($client)
    {
        $query = 'INSERT INTO clients (lastName, firstName, birthDate, card, cardNumber) 
                    VALUES (:lastName, :firstName, :birthDate, :card, :cardNumber)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':lastName', $client['last_name']);
        $stmt->bindValue(':firstName', $client['first_name']);
        $stmt->bindValue(':birthDate', $client['birth_date']);
        $stmt->bindValue(':card', $client['has_card']);
        $stmt->bindValue(':cardNumber', $client['card_number']);
        $stmt->execute();

        $query = 'INSERT INTO cards (cardNumber, cardTypesId) VALUES (:cardNumber, :cardTypesId)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':cardNumber', $client['card_number']);
        $stmt->bindValue(':cardTypesId', $client['card_type']);

        $stmt->execute();
    }

    public function createShow($show)
    {
        $query = 'INSERT INTO shows (title, performer, date, showTypesId, firstGenresId, secondGenreId, duration, startTime) 
                    VALUES (:title, :performer, :date, :showTypesId, :firstGenresId, :secondGenreId, :duration, :startTime)';
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':title', $show['title']);
        $stmt->bindValue(':performer', $show['performer']);
        $stmt->bindValue(':date', $show['date']);
        $stmt->bindValue(':showTypesId', $show['showTypesId']);
        $stmt->bindValue(':firstGenresId', $show['firstGenresId']);
        $stmt->bindValue(':secondGenreId', $show['secondGenreId']);
        $stmt->bindValue(':duration', $show['duration']);
        $stmt->bindValue(':startTime', $show['startTime']);
        $stmt->execute();
    }

    public function getCardTypes()
    {
        $query = "SELECT * FROM cardtypes";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getShowTypes()
    {
        $query = "SELECT * FROM showtypes";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGender()
    {
        $query = "SELECT * FROM genres";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateClient($client)
    {
        $query = "UPDATE clients 
                    SET lastName=:lastName, firstName=:firstName, birthDate=:birthDate, card=:card, cardNumber=:cardNumber WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $client['id']);
        $stmt->bindValue(':lastName', $client['lastName']);
        $stmt->bindValue(':firstName', $client['firstName']);
        $stmt->bindValue(':birthDate', $client['birthDate']);
        $stmt->bindValue(':card', $client['card']);
        $stmt->bindValue(':cardNumber', $client['cardNumber']);

        $stmt->execute();
    }

    public function updateShow($show)
    {
        $query = "UPDATE shows 
                    SET title=:title,performer=:performer, date=:date, duration=:duration, firstGenresId=:firstGenresId,
                        secondGenreId=:secondGenreId, showTypesId=:showTypesId, startTime=:startTime
                    WHERE id=:id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $show['id']);
        $stmt->bindValue(':title', $show['title']);
        $stmt->bindValue(':performer', $show['performer']);
        $stmt->bindValue(':date', $show['date']);
        $stmt->bindValue(':duration', $show['duration']);
        $stmt->bindValue(':firstGenresId', $show['firstGenresId']);
        $stmt->bindValue(':secondGenreId', $show['secondGenreId']);
        $stmt->bindValue(':showTypesId', $show['showTypesId']);
        $stmt->bindValue(':startTime', $show['startTime']);

        $stmt->execute();
    }
}

class Database
{
    private static $instance = null;
    private $connection;

    private $server = 'localhost';
    private $currentDB = 'colyseum';
    private $user = 'root';
    private $password = '';

    private function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=$this->server;dbname=$this->currentDB", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec('set names utf8');
            //echo $this->server . " connected successfully" . PHP_EOL;
        } catch (PDOException $error) {
            echo "Connection failed: " . $error->getMessage();
            die;
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }


    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }
}
