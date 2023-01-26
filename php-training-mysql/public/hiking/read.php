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

<body class="flex flex-col bg-slate-900 items-center text-gray-50 h-screen">

<header class="flex flex-row p-5 items-end">
    <a class="m-5" href="create.php">Create a hiking</a>

    <form class="m-5" action="../user/logout.php" method="post">
        <input type="submit" value="Logout">
    </form>

</header>
<main class="flex flex-col">
    <h1 class="my-4">Liste des randonnées</h1>
    <table class="min-w-full">
        <thead class="text-xs uppercase bg-gray-50 bg-gray-700 text-gray-400">
        <tr>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercasetext-gray-400">
                Name
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
                Difficulty
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
                Distance
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
                Duration
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
                Height difference
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
                Available
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400"> OPTIONS
            </th>
            <th scope="col"
                class="py-3 px-6 text-xs font-medium uppercase text-gray-400">
            </th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($hikes as $hiking) {
            ?>
            <tr class="border-b bg-gray-800 border-gray-700">
                <td class="py-4 px-6 "><?php echo $hiking['name'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['difficulty'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['distance'] . ' m' ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['duration'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['height_difference'] . ' m' ?></td>
                <td class="py-4 px-6 "><?php echo ($hiking['available']) ? 'True' : 'False' ?></td>
                <td class="py-4 px-6 ">
                    <form action="delete.php" method="post">
                        <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>
                <td class="py-4 px-6 ">
                    <form action="update.php" method="post">
                        <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                        <button type="submit" name="update">Update</button>
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>

</main>
</body>

</html>