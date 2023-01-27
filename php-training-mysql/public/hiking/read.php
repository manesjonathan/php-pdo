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
    <link rel="stylesheet" href="../assets/css/output.css">
</head>

<body class="flex flex-col items-center text-gray-50 h-screen bg-background bg-no-repeat bg-cover bg-center bg-fixed">

<header class="flex flex-row p-5 items-end place-self-end">
    <a class="text-white ring-2 outline-none font-medium m-5 rounded-lg px-5 py-2.5 text-center bg-gray-700 bg-opacity-70"
       href="create.php">CREATE HIKING</a>

    <form class="text-white ring-2 outline-none font-medium m-5 rounded-lg px-5 py-2.5 text-center bg-gray-700 bg-opacity-70"
          action="../user/logout.php" method="post">
        <input type="submit" value="LOGOUT">
    </form>

</header>
<main class="flex flex-col">
    <h1 class="my-4 text-2xl">HIKING LIST</h1>
    <table class="rounded-md bg-clip-padding backdrop-filter backdrop-blur-sm bg-gray-700 bg-opacity-70 border border-gray-100">
        <thead class="text-xs uppercase text-gray-50">
        <tr>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Name
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Difficulty
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Distance
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Duration
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Height difference
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
                Available
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50"> OPTIONS
            </th>
            <th scope="col"
                class="py-3 px-6 text-sm font-medium uppercase text-gray-50">
            </th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($hikes as $hiking) {
            ?>
            <tr class="border-b bg-gray-800 border-gray-700 bg-opacity-70">
                <td class="py-4 px-6 "><?php echo $hiking['name'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['difficulty'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['distance'] . ' m' ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['duration'] ?></td>
                <td class="py-4 px-6 "><?php echo $hiking['height_difference'] . ' m' ?></td>
                <td class="py-4 px-6 "><?php echo ($hiking['available']) ? 'True' : 'False' ?></td>
                <td class="py-4 px-6 ">
                    <form action="update.php" method="post">
                        <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                        <button type="submit" name="update">Update</button>
                    </form>
                </td>
                <td class="py-4 px-6 ">
                    <form action="delete.php" method="post">
                        <input type="hidden" name="hiking_id" value="<?php echo $hiking['id'] ?>">
                        <input type="submit" name="delete" value="Delete">
                    </form>

            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>

</main>
</body>

</html>