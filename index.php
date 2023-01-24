<?php

require __DIR__ . '/database/Database.php';
$dbInstance = Database::get_instance();
$connection = $dbInstance->get_connection();

$stmt = $connection->prepare('SELECT * FROM Météo');
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['delete-id'])) {
    $stmt = $connection->prepare('DELETE FROM Météo WHERE id = :id');
    $stmt->bindParam(':id', $_POST['delete-id']);
    $stmt->execute();
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}

if (isset($_POST['ville']) && isset($_POST['haut']) && isset($_POST['bas'])) {
    $stmt = $connection->prepare('INSERT INTO Météo (ville, haut, bas) VALUES (:ville, :haut, :bas)');
    $stmt->bindParam(':ville', $_POST['ville']);
    $stmt->bindParam(':haut', $_POST['haut']);
    $stmt->bindParam(':bas', $_POST['bas']);
    $stmt->execute();
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Weather app">
    <title>Weather app</title>
    <style>
        body {
            background-color: #191d24;
            color: white;
        }
    </style>

</head>

<body>
    <main>
        <table>
            <tr>
                <th>Ville</th>
                <th>Haut</th>
                <th>Bas</th>
                <th>Delete</th>
            </tr>
            <?php
            foreach ($result as $row) {
            ?>
                <tr>
                    <td><?php echo $row['ville']; ?></td>
                    <td><?php echo $row['haut']; ?></td>
                    <td><?php echo $row['bas']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="delete-id" value="<?php echo $row['id']; ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <form action="" method="post">
            <label for="ville">Ville:</label>
            <input type="text" name="ville" id="ville">
            <label for="haut">Haut:</label>
            <input type="haut" name="haut" id="haut">
            <label for="bas">Bas:</label>
            <input type="bas" name="bas" id="bas">
            <input type="submit" value="Envoyer">
        </form>
    </main>
</body>

</html>