<?php
    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';

    if (Security::isAccessTokenValid()) {
        header('Location: /index.php');
        exit;
    }

    Security::createCSRFToken();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden">

    <div class="flex gap-10 h-screen overflow-hidden">
        <div class="h-screen w-[70%] flex justify-center items-center form-container absolute top-0 left-[30%] transition-all delay-100 duration-300">
            
            <a href="/index.php" class="absolute top-5 left-10 text-[#00A5CF] text-2xl font-semibold" style="font-family: 'Playwrite IN', serif;">Youdemy</a>

            <!-- Log in Form -->

            <form action="/validation/login.php" method="POST" class="py-7 px-9 max-w-xl w-full rounded-xl login-form transition-all delay-100 duration-200 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <h1 class="text-center mb-14 text-gray-700 font-extrabold text-4xl form-title">Login to Your Account</h1>
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="px-5 py-4 rounded border border-red-500 bg-red-100 mb-7 -mt-5 text-center">
                        <ul>
                            <?php
                                foreach($_SESSION["errors"] as $error) {
                                    echo "<li>$error</li>";
                                }
                                session_destroy();
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <input type="hidden" name="CSRF_token" value="<?php echo $_SESSION["CSRF_token"]; ?>">
                <div class="mb-7">
                    <label for="email" class="mb-2 block sr-only">Email</label>
                    <input type="text" name="email" placeholder="Email" id="email" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                </div>
                <div class="mb-7">
                    <label for="password" class="mb-2 block sr-only">Password</label>
                    <input type="password" name="password" placeholder="Password" id="password" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                </div>
                <button type="submit" class="w-44 h-12 block mx-auto rounded-full font-semibold text-white bg-[#00A5CF] hover:bg-[#005469] transition-colors">Log In</button>
            </form>
        </div>


        <div class="w-[30%] bg-gradient-to-r to-[#00A5CF] from-[#005469] h-screen register-bar flex flex-col justify-center items-center text-white px-10 text-center transition duration-300 absolute top-0 left-0">
            <h2 class="mb-10 text-3xl font-bold">New Here?</h2>
            <p class="text-md">Register and discover plenty of blogs that would interest you.</p>
            <a href="register.php" class="bg-white w-44 rounded-full mt-7 text-[#005469] font-semibold register-btn py-3.5">Register</button>
        </div>
    </div>

</body>
</html>