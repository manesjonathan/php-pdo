<?php

namespace App\database;
use PDO;

require_once __DIR__.'/DbInterface.php';

class Database implements DbInterface
{
    private static $instance = null;
    private $connection;

    private $server = DbInterface::HOST;
    private $currentDB = DbInterface::DBNAME;
    private $user = DbInterface::USER;
    private $password = DbInterface::PASSWORD;

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
