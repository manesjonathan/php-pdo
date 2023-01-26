<?php
require_once __DIR__.'/../../database/UserService.php';
use App\Database\UserService;

$user_service = new UserService();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $is_user = $user_service->login($username, $password);
    session_start();

    if ($is_user) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: ../hiking/read.php');
    } else {
        $_SESSION['error_message'] = 'Sorry, you are not registered';
        header('location: ../index.php');

    }
}
