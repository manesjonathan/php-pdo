<?php

use model\Hiking;

session_start();
include_once '../../database/HikingService.php';
include_once '../../database/model/Hiking.php';

if (isset($_POST['name']) && isset($_POST['difficulty']) && isset($_POST['distance']) && isset($_POST['duration']) && isset($_POST['height_difference'])) {
    $name = $_POST['name'];
    $difficulty = $_POST['difficulty'];
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $available = $_POST['available'];
    $height_difference = $_POST['height_difference'];

    $hiking = new Hiking();
    $hiking->setName($name);
    $hiking->setDifficulty($difficulty);
    $hiking->setDistance($distance);
    $hiking->setDuration($duration);
    if ($available == "true") {
        $availability_bool = true;
    } else {
        $availability_bool = false;
    }
    $hiking->setAvailability($availability_bool);
    $hiking->setHeightDifference($height_difference);
    $hikingService = new HikingService();
    $hikingService->createHiking($hiking);

    $_SESSION['message'] = "Hiking added successfully.";

    header('Location: read.php');
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