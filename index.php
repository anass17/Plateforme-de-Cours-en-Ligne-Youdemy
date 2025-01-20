<?php

    require __DIR__ . '/classes/Database.php';
    require __DIR__ . '/classes/Security.php';

    $role = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900 font-sans">

    <nav class="absolute top-0 left-0 w-full">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-14">
            <a href="#" class="text-white text-2xl font-bold" style="font-family: 'Playwrite IN', serif;">Youdemi</a>
            <div class="space-x-6 text-white *:font-semibold">
                <a href="#" class="hover:text-gray-300">Home</a>
                <a href="/pages/courses.php" class="hover:text-gray-300">Courses</a>
                <a href="/pages/login.php" class="hover:text-gray-300">Login</a>
                <a href="/pages/register.php" class="hover:text-gray-300">Register</a>
            </div>
        </div>
    </nav>

    <section class="bg-gradient-to-br to-[#00A5CF] from-[#00526a] h-screen text-white text-center py-20 flex justify-center items-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-5" style="font-family: 'Playwrite IN', serif;">Welcome to Youdemi</h1>
            <p class="text-xl mb-16 opacity-85">Start learning new skills today, anytime, anywhere!</p>
            <a href="/pages/courses.php" class="bg-white bg-opacity-85 text-gray-600 py-3 px-7 inline-block rounded-full text-lg font-semibold transition duration-300 hover:bg-opacity-100">Browse Courses</a>
        </div>
    </section>

</body>
</html>

</body>
</html>