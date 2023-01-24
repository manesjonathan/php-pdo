<?php

include_once('DbInterface.php');

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

    public function get_connection()
    {
        return $this->connection;
    }


    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }

        return self::$instance;
    }


    public function get_query_result($query)
    {
        try {
            $query = $this->connection->prepare($query);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            echo "Query error:"  . $error->getMessage();
        }
    }
}
