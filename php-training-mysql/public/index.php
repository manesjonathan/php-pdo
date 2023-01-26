<?php

session_start();
if (isset($_SESSION['error_message'])){
    echo $_SESSION['error_message'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title">
</head>
<body>

<form action="user/check_login.php" method="post">
    <div>
        <label for="username">Identifiant
            <input type="text" name="username">
        </label>
    </div>
    <div>
        <label for="password">Mot de passe
            <input type="password" name="password">
        </label>
    </div>
    <div>
        <input type="submit" value="Se connecter">
    </div>
</form>
</body>
</html>
