
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
        <div class="h-screen w-[70%] flex justify-center items-center form-container absolute top-0 transition-all delay-100 duration-300 left-0">

            <a href="/index.php" class="absolute top-5 left-10 text-[#00A5CF] text-2xl font-semibold" style="font-family: 'Playwrite IN', serif;">Youdemy</a>

            <!-- Register Form -->

            <form action="/validation/register.php" method="POST" class="py-7 px-9 max-w-xl w-full rounded-xl register-form transition-all duration-300 delay-100 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <h1 class="text-center mb-14 text-gray-700 font-extrabold text-4xl form-title">Create a new Account</h1>
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
                <div class="flex gap-4 mb-4">
                    <div class="w-full">
                        <label for="first-name" class="mb-2 block sr-only">First Name</label>
                        <input type="text" name="first-name" placeholder="First Name" id="first-name" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                    </div>
                    <div class="w-full">
                        <label for="last-name" class="mb-2 block sr-only">Last Name</label>
                        <input type="text" name="last-name" placeholder="Last Name" id="last-name" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="email" class="mb-2 block sr-only">Email</label>
                    <input type="text" name="email" placeholder="Email" id="email" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="mb-2 block sr-only">Password</label>
                    <input type="password" name="password" placeholder="Password" id="password" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                </div>
                <div class="mb-4">
                    <label for="account-type" class="mb-2 block sr-only">Account Type</label>
                    <select name="account-type" id="account-type" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                        <option value="">Select</option>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <div id="teacher-inputs" class="hidden">
                    <div class="mb-4">
                        <label for="title" class="mb-2 block sr-only">Teacher Title</label>
                        <input type="text" name="title" placeholder="Teacher Title" id="title" class="outline-none border border-[#00A5CF] px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500">
                    </div>
                    <div class="mb-4">
                        <label for="bio" class="mb-2 block sr-only">Teacher Bio</label>
                        <textarea type="text" name="bio" placeholder="Teacher Bio" id="bio" class="outline-none border border-[#00A5CF] h-32 px-4 py-2 w-full rounded-lg bg-[#005469] bg-opacity-10 placeholder:text-gray-500"></textarea>
                    </div>
                </div>
                <button type="submit" class="w-44 h-12 block mx-auto rounded-full font-semibold text-white bg-[#00A5CF] hover:bg-[#005469] transition-colors">Register</button>
            </form>
        </div>

        <div class="w-[30%] bg-gradient-to-tr to-[#00A5CF] from-[#005469] h-screen login-bar flex flex-col justify-center items-center text-white px-7 text-center transition duration-300 delay-300 absolute top-0 left-[70%]">
            <h2 class="mb-10 text-3xl font-bold">Already a member?</h2>
            <p class="text-md">Log into your account and continue the journey. Don't miss it</p>
            <a href="login.php" class="bg-white w-44 rounded-full mt-7 text-[#005469] py-3 font-semibold login-btn">Login</a>
        </div>
    </div>

    <script>
        let teacherInputs = document.getElementById('teacher-inputs');
        document.querySelector('#account-type').addEventListener('click', function () {
            if (this.value == "teacher") {
                teacherInputs.classList.remove('hidden');
            } else {
                teacherInputs.classList.add('hidden');
            }
        });
    </script>

</body>
</html>