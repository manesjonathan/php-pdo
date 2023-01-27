<?php


require_once '../php-exercises-crud/service/Service.php';
require_once '../php-exercises-crud/service/Helper.php';
$service = new Service();
$clients_list = $service->readClients();
$show_types = $service->readShowTypes();
$clients_20 = $service->read20Clients();
$clients_with_card = $service->readClientsWithCard();
$clients_starts_m = $service->readClientsStartsM();
$shows = $service->readShows();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Exercices Part 1</title>

    <style>
        section {
            margin: 2%;
        }

        label {
            display: flex;
            flex-direction: column;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
        }

        article {
            border: #191d24 solid 1px;
            padding: 2%;
            margin: 2%;
        }

        .title {
            margin: 2%;
        }
    </style>
</head>
<body>
<header><a href="next.php">Next page</a></header>
<main>
    <section>
        <label for="clients">Exercise 1: Clients
            <select name="clients">
                <?php
                foreach ($clients_list as $client) {
                    ?>
                    <option value=""><?php print_r($client) ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <section>
        <label for="types">Exercise 2: Show types
            <select name="types">
                <?php
                foreach ($show_types as $type) {
                    ?>
                    <option value=""><?php print_r($type) ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <section>
        <label for="clients_20">Exercise 3: Show 20 clients
            <select name="clients_20">
                <?php
                foreach ($clients_20 as $client) {
                    ?>
                    <option value=""><?php print_r($client) ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <section>
        <label for="clients_card">Exercise 4: Show clients with card
            <select name="clients_card">
                <?php
                foreach ($clients_with_card as $client) {
                    ?>
                    <option value=""><?php print_r($client) ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <section>
        <label for="clients_starts_m">Exercise 5: Show clients with starting with 'M'
            <select name="clients_starts_m">
                <?php
                foreach ($clients_starts_m as $client) {
                    ?>
                    <option value=""><?php echo 'Nom  :' . $client['lastName'] . ', ' .
                            'Prénom : ' . $client['firstName'] ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <section>
        <label for="shows">Exercise 6: Shows
            <select name="shows">
                <?php
                foreach ($shows as $show) {
                    ?>
                    <option value=""><?php echo $show['title'] . ' par ' . $show['performer'] . ', le ' . $show['date'] . ' à ' . $show['startTime'] ?></option>
                <?php } ?>
            </select>
        </label>
    </section>
    <p class="title">Exercise 7:</p>

    <section class="container">
        <?php
        foreach ($clients_list as $client) {
            ?>
            <article>
                <p>Nom : <?php echo $client['lastName'] ?></p>
                <p>Prénom : <?php echo $client['firstName'] ?></p>
                <p>Date de naissance : <?php echo $client['birthDate'] ?></p>
                <p>Carte de fidelité : <?php echo ($client['card'] == 1) ? 'Yes' : 'No' ?></p>
                <?php if ($client['card'] == 1) {

                    ?>
                    <p>Numéro de carte : <?php echo $client['cardNumber'] ?></p>
                <?php } ?>
            </article>
            <?php
        } ?>
    </section>
</main>
</body>
</html>