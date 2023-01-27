<?php


require_once '../php-exercises-crud/service/Service.php';
require_once '../php-exercises-crud/service/Helper.php';

$service = new Service();

$card_type_list = $service->getCardTypes();
$show_types = $service->getShowTypes();
$gender_list = $service->getGender();
$client_to_update = $service->getClientByName('Perry')[0];
$show_to_update = $service->getShowByName('Vestibulum accumsan')[0];

//Exercice 1 et 2
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

//Exercice 3
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

//Exercice 4
if (isset($_POST['update'])) {
    $last_name = $_POST['last_name_up'];
    $first_name = $_POST['first_name_up'];
    $birth_date = $_POST['birth_date_up'];
    $has_card = ($_POST['has_card_up'] == "true") ? 1 : 0;
    $card_number = $has_card == 1 ? $_POST['card_number_up'] : null;

    //create user
    $client = [
        'id' => $client_to_update['id'],
        'lastName' => $last_name,
        'firstName' => $first_name,
        'birthDate' => $birth_date,
        'card' => $has_card,
        'cardNumber' => $card_number,
    ];
    $service->updateClient($client);
    header('Location: part_two.php');
}

//Exercice 5
if (isset($_POST['update_show'])) {
    $title = $_POST['title_up'];
    $performer = $_POST['performer_up'];
    $date = $_POST['date_up'];
    $show_types_id = $_POST['showTypesId_up'];
    $first_gender_id = $_POST['firstGenresId_up'];
    $second_gender_id = $_POST['secondGenreId_up'];
    $duration = $_POST['duration_up'];
    $start_time = $_POST['startTime_up'];

    $show = [
        'id' => $show_to_update['id'],
        'title' => $title,
        'performer' => $performer,
        'date' => $date,
        'showTypesId' => $show_types_id,
        'firstGenresId' => $first_gender_id,
        'secondGenreId' => $second_gender_id,
        'duration' => $duration,
        'startTime' => $start_time
    ];

    $service->updateShow($show);
    header('Location: part_two.php');
}

//Exercice 6 (Je n'ai pas adapté/créé de formulaire, j'ai juste créé la méthode + query en db)
$client_five = $service->getClientById(5)[0];
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
        section {
            margin: 2%;
        }

        form {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
<header><a href="index.php">First page</a></header>

<main>

    <!--Exercice 1 et 2-->
    <section>
        <p>Exercice 1 et 2:</p>
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
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?>"</option>
                    <?php }
                    ?>
                </select>
            </label>
            <button type="submit" name="submit">Envoyer</button>
        </form>
    </section>

    <!--Exercice 3 -->
    <section>
        <p>Exercice 3:</p>
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
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?>"</option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="firstGenresId">Genre de spectacle (1):
                <select name="firstGenresId">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?>"</option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="secondGenreId">Genre de spectacle (2):
                <select name="secondGenreId">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?>"</option>
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

    <!--Exercice 4 -->
    <section>
        <p>Exercice 4:</p>
        <form action="" method="post">
            <label for="last_name_up">Nom:
                <input type="text" required name="last_name_up" value="<?php echo $client_to_update['lastName']; ?>">
            </label>
            <label for="first_name_up">Prénom:
                <input type="text" required name="first_name_up" value="<?php echo $client_to_update['firstName']; ?>">
            </label>
            <label for="birth_date_up">Date de naissance:
                <input type="date" required name="birth_date_up" value="<?php echo $client_to_update['birthDate']; ?>">
            </label>
            <label for="has_card_up">Carte de fidelité
                <input type="radio" name="has_card_up"
                       value="true" <?php echo $client_to_update['card'] ? 'checked' : ''; ?>>True
                <input type="radio" name="has_card_up"
                       value="false" <?php echo !$client_to_update['card'] ? 'checked' : ''; ?>>False
            </label>
            <label for="card_number_up">Numéro de carte:
                <input type="number" name="card_number_up" value="<?php echo $client_to_update['cardNumber']; ?>">
            </label>
            <button type="submit" name="update">Envoyer</button>
        </form>
    </section>

    <!--Exercice 5 -->
    <section>
        <p>Exercice 5:</p>
        <form action="" method="post">
            <label for="title_up">Titre:
                <input type="text" name="title_up" required value="<?php echo $show_to_update['title'] ?>">
            </label>
            <label for="performer_up">Artiste:
                <input type="text" name="performer_up" required value="<?php echo $show_to_update['performer'] ?>">
            </label>
            <label for="date_up">Date:
                <input type="date" name="date_up" required value="<?php echo $show_to_update['date'] ?>">
            </label>
            <label for="showTypesId_up">Type de spectacle:
                <select name="showTypesId_up">
                    <?php foreach ($show_types as $type) {
                        ?>
                        <option <?php echo $show_to_update['showTypesId'] == $type['id'] ? 'selected' : '' ?>
                                value="<?php echo $type['id']; ?>"> <?php echo $type['type']; ?>
                        </option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="firstGenresId_up">Genre de spectacle (1):
                <select name="firstGenresId_up">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option <?php echo $show_to_update['firstGenresId'] == $gender['id'] ? 'selected' : '' ?>
                                value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="secondGenreId_up">Genre de spectacle (2):
                <select name="secondGenreId_up">
                    <?php foreach ($gender_list as $gender) {
                        ?>
                        <option <?php echo $show_to_update['secondGenreId'] == $gender['id'] ? 'selected' : '' ?>
                                value="<?php echo $gender['id']; ?>"><?php echo $gender['genre']; ?></option>
                    <?php }
                    ?>
                </select>
            </label>
            <label for="duration_up">Durée:
                <input type="time" name="duration_up" required value="<?php echo $show_to_update['duration'] ?>">
            </label>
            <label for="startTime_up">Heure de début:
                <input type="time" name="startTime_up" required value="<?php echo $show_to_update['startTime'] ?>">
            </label>
            <button type="submit" name="update_show">Envoyer</button>
        </form>
    </section>

</main>
</body>
</html>