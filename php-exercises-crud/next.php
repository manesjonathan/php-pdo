<?php


require_once '../php-exercises-crud/service/Service.php';
require_once '../php-exercises-crud/service/Helper.php';
$service = new Service();

$card_type_list = $service->getCardTypes();

if (isset($_POST['submit'])) {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $birth_date = $_POST['birth_date'];
    $has_card = ($_POST['has_card'] == "true") ? 1: 0;
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
</main>
</body>
</html>