<?php

namespace App\database;
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/model/User.php';

use App\database\model\User;
use PDO;

class UserDAO
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findByName($username): User
    {
        $query = 'SELECT * FROM user WHERE username = :username';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, User::class);

        $user = $stmt->fetch();
        return $user;
    }

    /*public static function register(): void
    {
        $db = Database::getInstance()->getConnection();

        $query = 'INSERT INTO user (username, email, password) VALUES (:username, :email, :password)';

        $stmt = $db->prepare($query);
        $username = "admin";
        $email = "admin@admin.be";
        $password = password_hash('password', PASSWORD_BCRYPT);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }*/

}
