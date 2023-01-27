<?php


require_once '../php-exercises-crud/service/Service.php';
require_once '../php-exercises-crud/service/Helper.php';

$service = new Service();

$card_type_list = $service->getCardTypes();
$show_types = $service->getShowTypes();
$gender_list = $service->getGender();

if (isset($_POST['submit'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $birth_date = $_POST['birth_date'];
    $has_card = ($_POST['has_card'] == "true") ? 1 : 0;
    $card_number = $has_card == 1 ? $_POST['card_number'] : null;
    $card_type = $_POST['card_type'] ?? null;

    //create user
    $client = [
        'last_name' => $last_name,
        'first_name' => $first_name,
        'birth_date' => $birth_date,
        'has_card' => $has_card,
        'card_number' => $card_number,
        'card_type' => $card_type
    ];
    $service->createClient($client);
    header('Location: index.php');

}

if (isset($_POST['submit_show'])) {
    $title = $_POST['title'];
    $performer = $_POST['performer'];
    $date = $_POST['date'];
    $show_types_id = $_POST['showTypesId'];
    $first_gender_id = $_POST['firstGenresId'];
    $second_gender_id = $_POST['secondGenreId'];
    $duration = $_POST['duration'];
    $start_time = $_POST['startTime'];


    $show = [
        'title' => $title,
        'performer' => $performer,
        'date' => $date,
        'showTypesId' => $show_types_id,
        'firstGenresId' => $first_gender_id,
        'secondGenreId' => $second_gender_id,
        'duration' => $duration,
        'startTime' => $start_time
    ];

    $service->createShow($show);
    header('Location: index.php');

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Exercices Part 2</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<main>
    <section>
        <p>Exercice 1:</p>
        <form action="" method="post">
            <label>Nom:
                <input type="text" required name="last_name">
            </label>
            <label>Prénom:
                <input type="text" required name="first_name">
            </label>
            <label>Date de naissance:
                <input type="date" required name="birth_date">
            </label>

            <label for="has_card">Carte de fidelité
                <input type="radio" name="has_card" value="true">True
                <input type="radio" name="has_card" value="false">False
            </label>
            <label>Numéro de carte:
                <input type="number" name="card_number">
            </label>

            <label for="card_type">Type de carte
                <select name="card_type">
                    <?php foreach ($card_type_list as $type) {
                        ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <button type="submit" name="submit">Envoyer</button>
        </form>
    </section>

    <section>
        <p>Exercice 2:</p>
        <form action="" method="post">
            <label for="title">Titre:
                <input type="text" name="title" required>
            </label>
            <label for="performer">Artiste:
                <input type="text" name="performer" required>
            </label>
            <label for="date">Date:
                <input type="date" name="date" required>
            </label>
            <label for="showTypesId">Type de spectacle:
                <select name="showTypesId">
                    <?php foreach ($show_types as $type) {
                        ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="firstGenresId">Genre de spectacle (1):
                <select name="firstGenresId">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="secondGenreId">Genre de spectacle (2):
                <select name="secondGenreId">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="duration">Durée:
                <input type="time" name="duration" required>
            </label>
            <label for="startTime">Heure de début:
                <input type="time" name="startTime" required>
            </label>
            <button type="submit" name="submit_show">Envoyer</button>
        </form>
    </section>
</main>
</body>
</html>