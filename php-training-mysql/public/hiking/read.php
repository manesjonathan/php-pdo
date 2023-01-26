<?php
require_once '../../database/HikingService.php';

session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    if (isset($_SESSION['message'])) {
        echo '<div>' . $_SESSION['message'] . '</div>';
        header("Refresh:3; url=read.php");
        unset($_SESSION['message']);
    }

    $HikingService = new HikingService();
    $hikes = $HikingService->readHikes();
} else {
    $_SESSION['error_message'] = 'Sorry, you are not connected';
    header('location: ../index.php');

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-indigo-500 text-white p-10">

<header>
    <form action="../user/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</header>
<h1>Liste des randonnées</h1>
<a class="btn-" href="create.php">Create a hiking</a>
<table>
    <tr>
        <th>Name</th>
        <th>Difficulty</th>
        <th>Distance</th>
        <th>Duration</th>
        <th>Height difference</th>
        <th>Available</th>
    </tr>
    <?php
    foreach ($hikes as $hiking) {
        ?>
        <tr>
            <td><?php echo $hiking['name'] ?></td>
            <td><?php echo $hiking['difficulty'] ?></td>
            <td><?php echo $hiking['distance'] . ' m' ?></td>
            <td><?php echo $hiking['duration'] ?></td>
            <td><?php echo $hiking['height_difference'] . ' m' ?></td>
            <td><?php echo ($hiking['available']) ? 'True' : 'False' ?></td>
            <td>
                <form action="delete.php" method="post">
                    <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                    <input type="submit" name="delete" value="Delete">
                </form>
            <td>
                <form action="update.php" method="post">
                    <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                    <button type="submit" name="update">Update</button>
                </form>
            </td>
        </tr>
        <?php

    }
    ?>
</table>
</body>

</html>