<?php
include_once('../../database/HikingService.php');

session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    $hiking_displayed = null;
    $hikingService = new HikingService();

    if (isset($_POST['update'])) {
        $id = $_POST['hiking_id'];
        $hiking_displayed = $hikingService->getHikingById($id);
    }

    if (isset($_POST['submit'])) {
        $id = $_POST['hiking_id'];
        $hiking = $hikingService->getHikingById($id);
        $hiking->setName($_POST['name']);
        $hiking->setDifficulty($_POST['difficulty']);
        $hiking->setDistance($_POST['distance']);
        $hiking->setDuration($_POST['duration']);
        $hiking->setHeightDifference($_POST['height_difference']);
        if ($_POST['available'] == "true") {
            $availability_bool = true;
        } else {
            $availability_bool = false;
        }
        $hiking->setAvailability($availability_bool);
        $hikingService->updateHiking($hiking);
        header('Location: read.php');
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
<a href="read.php">Liste des données</a>
<h1>Ajouter</h1>
<form action="" method="post">
    <div>
        <label for="name">Name
            <input type="text" name="name" value="<?php echo $hiking_displayed->getName() ?>">
        </label>
    </div>

    <div>
        <label for="difficulty">Difficulté
            <select name="difficulty">
                <option value="très facile" <?php echo $hiking_displayed->getDifficulty() == "très facile" ? "selected" : "" ?>>
                    Très
                    facile
                </option>
                <option value="facile" <?php echo $hiking_displayed->getDifficulty() == "facile" ? "selected" : "" ?>>
                    Facile
                </option>
                <option value="moyen" <?php echo $hiking_displayed->getDifficulty() == "moyen" ? "selected" : "" ?>>
                    Moyen
                </option>
                <option value="difficile" <?php echo $hiking_displayed->getDifficulty() == "difficile" ? "selected" : "" ?>>
                    Difficile
                </option>
                <option value="très difficile" <?php echo $hiking_displayed->getDifficulty() == "très difficile" ? "selected" : "" ?>>
                    Très difficile
                </option>
            </select>
        </label>
    </div>
    <div>
        <label for="available"> Available
            <input type="radio" name="available" value="true"
                <?php echo $hiking_displayed->getAvailability() ? "checked" : null ?>>True
            <input type="radio" name="available" value="false"
                <?php echo $hiking_displayed->getAvailability() ? "" : "checked" ?>>False

        </label>
    </div>
    <div>
        <label for="distance">Distance
            <input type="text" name="distance" value="<?php echo $hiking_displayed->getDistance() ?>">
        </label>
    </div>
    <div>
        <label for="duration">Durée
            <input type="time" name="duration" value=<?php echo $hiking_displayed->getDuration() ?>>
        </label>
    </div>
    <div>
        <label for="height_difference">Dénivelé
            <input type="text" name="height_difference" value=<?php echo $hiking_displayed->getHeightDifference();
            $_POST['update'] = null ?>>
        </label>
    </div>
    <form action="" method="post">
        <input type="hidden" name="hiking_id" value=<?php echo $hiking_displayed->getId() ?>>
        <button type="submit" name="submit">Submit</button>
    </form>
</form>
</body>

</html>