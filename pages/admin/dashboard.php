<?php
    $role = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
</head>
<body>

    <?php
        include __DIR__ . '/../../inc/header.php';
    ?>

    <div class="py-16 text-center max-w-[1250px] mx-auto px-3">
        <h1 class="mb-12 font-semibold text-4xl">Dashboard</h1>
        <div class="flex gap-8 mb-8 *:w-full *:px-3 *:py-6 *:shadow-md">
            <div class="rounded bg-gradient-to-tr from-[#FFD9D9] to-[#FF6A6A]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
            <div class="rounded bg-gradient-to-tr from-[#F2FF00] to-[#FFAF3F]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
            <div class="rounded bg-gradient-to-tr from-[#6EFFF3] to-[#5BFF50]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
            <div class="rounded bg-gradient-to-tr from-[#FFEBEB] to-[#DEA8FF]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
        </div>
        <div class="flex gap-8 mb-8 justify-center *:w-[calc(25%-1.5rem)] *:px-3 *:py-6 *:shadow-md">
            <div class="rounded bg-gradient-to-tr from-[#FFD9D9] to-[#FF6A6A]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
            <div class="rounded bg-gradient-to-tr from-[#F2FF00] to-[#FFAF3F]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
            <div class="rounded bg-gradient-to-tr from-[#6EFFF3] to-[#5BFF50]">
                <h4 class="font-semibold">Courses</h4>
                <span class="text-2xl">8</span>
            </div>
        </div>
    </div>

    <div class="flex justify-between gap-5 max-w-[1250px] mx-auto px-3">

        <!-- Top Teachers -->

        <div class="min-w-80">
            <h2 class="text-center mb-10 font-semibold text-xl">Top Teachers</h2>
            <div class="gap-5 flex justify-start items-center mb-3">
                <div class="rounded-full mb-2 w-14 h-14 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left">5 Courses</span>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3">
                <div class="rounded-full mb-2 w-14 h-14 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left">5 Courses</span>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3">
                <div class="rounded-full mb-2 w-14 h-14 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left">5 Courses</span>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3">
                <div class="rounded-full mb-2 w-14 h-14 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left">5 Courses</span>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3">
                <div class="rounded-full mb-2 w-14 h-14 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left">5 Courses</span>
                </div>
            </div>
        </div>

        <!-- Top Courses -->

        <div>
            <h2 class="text-center mb-10 font-semibold text-xl">Top Courses</h2>
            <div class="gap-8 flex justify-start items-center mb-3">
                <div class="bg-gray-100 rounded-md mb-2 w-72 h-40">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold text-lg text-[#00A5CF]">The ultimate course of PHP</h3>
                    <span class="text-gray-600 text-sm text-left">15 Jul 2025</span>
                    <p class="text-gray-700 my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed max</p>
                    <span class="text-sm text-gray-500">15 Subscriptions</span>
                </div>
            </div>
            <div class="gap-8 flex justify-start items-center mb-3">
                <div class="bg-gray-100 rounded-md mb-2 w-72 h-40">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold text-lg text-[#00A5CF]">The ultimate course of PHP</h3>
                    <span class="text-gray-600 text-sm text-left">15 Jul 2025</span>
                    <p class="text-gray-700 my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed max</p>
                    <span class="text-sm text-gray-500">15 Subscriptions</span>
                </div>
            </div>
            <div class="gap-8 flex justify-start items-center mb-3">
                <div class="bg-gray-100 rounded-md mb-2 w-72 h-40">
                    <img src="" alt="">
                </div>
                <div class="text-left">
                    <h3 class="font-semibold text-lg text-[#00A5CF]">The ultimate course of PHP</h3>
                    <span class="text-gray-600 text-sm text-left">15 Jul 2025</span>
                    <p class="text-gray-700 my-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed max</p>
                    <span class="text-sm text-gray-500">15 Subscriptions</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>