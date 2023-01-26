<?php

use model\Hiking;

include_once '../../database/HikingService.php';
include_once '../../database/model/Hiking.php';
session_start();

$error_message = "";
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    if (isset($_POST['name']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['height_difference']) && isset($_POST['available'])) {

        $name = filter_var($_POST["name"], FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$name || strlen($name) > 400) {
            $error_message .= "Invalid name. ";
        }

        $distance = filter_var($_POST["distance"], FILTER_SANITIZE_NUMBER_FLOAT);
        if (!$distance || $distance <= 0) {
            $error_message .= "Invalid distance. ";
        }

        $height_difference = filter_var($_POST["height_difference"], FILTER_SANITIZE_NUMBER_INT);
        if (!$height_difference || $height_difference <= 0) {
            $error_message .= "Invalid height difference. ";
        }

        $duration = $_POST['duration'];
        if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $duration)) {
            $error_message .= "Invalid duration. ";
        }

        $difficulty = $_POST['difficulty'];
        if (!in_array($difficulty, ["très facile", "facile", "moyen", "difficile", "très difficile"])) {
            $error_message .= "Invalid difficulty. ";
        }

        $available = $_POST['available'];
        if (!in_array($available, ["true", "false"])) {
            $error_message .= "Invalid availability. ";
        }

        if (empty($error_message)) {
            $hiking = new Hiking();
            $hiking->setName($name);
            $hiking->setDifficulty($difficulty);
            $hiking->setDistance($distance);
            $hiking->setDuration($duration);
            $hiking->setAvailability($available == "true");
            $hiking->setHeightDifference($height_difference);

            $hikingService = new HikingService();
            $hikingService->createHiking($hiking);

            header('Location: read.php');
        } else {
            echo $error_message . '<br>';
        }
    } else {
        echo 'Fill all required fields <br>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Ajouter une randonnée</title>
    <link rel="stylesheet" href="../css/basics.css" media="screen" title="no title">
</head>

<body>
<a href="../hiking/read.php">Liste des données</a>
<h1>Ajouter</h1>
<form action="" method="post">
    <div>
        <label for="name">Name
            <input type="text" name="name" value="">
        </label>
    </div>

    <div>
        <label for="difficulty">Difficulté
            <select name="difficulty">
                <option value="très facile">Très facile</option>
                <option value="facile">Facile</option>
                <option value="moyen">Moyen</option>
                <option value="difficile">Difficile</option>
                <option value="très difficile">Très difficile</option>
            </select>
        </label>
    </div>
    <div>
        <label for="available"> Available
            <input type="radio" name="available" value="true">True
            <input type="radio" name="available" value="false">False
        </label>
    </div>
    <div>
        <label for="distance">Distance
            <input type="text" name="distance" value="">
        </label>
    </div>
    <div>
        <label for="duration">Durée
            <input type="time" name="duration" value="">
        </label>
    </div>
    <div>
        <label for="height_difference">Dénivelé
            <input type="text" name="height_difference" value="">
        </label>
    </div>
    <button type="submit" name="button">Envoyer</button>
</form>
</body>

</html>