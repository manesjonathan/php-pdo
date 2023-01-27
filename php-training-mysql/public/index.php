<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/output.css" media="screen" title="no title">
</head>
<body class="flex flex-col items-center text-gray-50 h-screen bg-background bg-no-repeat bg-cover bg-center bg-fixed">
<main class="flex flex-col mb-auto mt-20 m-auto text-gray-50 w-full items-center justify-center">
    <section
            class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0 rounded-lg shadow border bg-gray-800 border-gray-700 bg-opacity-70">
        <img class="object-cover h-36 w-36 p-2" src="assets/image/logo.webp" alt="Logo">

        <article class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h2 class="text-xl font-bold leading-tight tracking-tight md:text-2xl text-white">
                Sign in to your account
            </h2>
            <form class="space-y-4 md:space-y-6" action="user/check_login.php" method="post">
                <section>
                    <label for="username" class="block mb-2 text-sm font-medium text-white">Username</label>
                    <input type="text" name="username"
                           class="border border-gray-300 sm:text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter your username" required="">
                </section>
                <section>
                    <label for="password"
                           class="block mb-2 text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                           class="border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           required="">
                </section>
                <button type="submit"
                        class="w-full text-white bg-primary-600 hover:bg-primary-700 ring-2 outline-none ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:ring-primary-800">
                    Sign in
                </button>
                <p class="w-full text-center">  <?php
                    if (isset($_SESSION['error_message'])) {
                        echo $_SESSION['error_message'];
                    }
                    ?></p>
            </form>
        </article>
    </section>
</main>

</body>
</html>
