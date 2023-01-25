<?php

namespace App\database;
require_once __DIR__.'/UserDAO.php';

class UserService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new UserDAO();
    }

    public function login($username, $password)
    {
        // Validate input
        if (empty($username) || empty($password)) {
            return false;
        }

        // Find the user by username
        $user = $this->dao->findByName($username);
        // Check if user exists and verify the password
        $hash = password_hash($user->getPassword(), PASSWORD_BCRYPT);

        if (password_verify($password, $hash)) {
            // Start a new session
            session_start();
            $_SESSION['user_id'] = $user->getId();
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
    }
}