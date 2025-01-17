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
        <h1 class="mb-12 font-semibold text-4xl">List of Users</h1>

        <div class="grid grid-cols-3 gap-14">
            <div class="gap-5 flex justify-start items-center mb-3 relative w-full">
                <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left flex-1">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left -mt-1 block">anass@gmail.com</span>
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm text-left font-bold">Student</span>
                        <span class="text-green-700 text-sm text-left font-bold">Active</span>
                    </div>
                </div>
                <div class="absolute top-2 right-2">
                    <button type="button">...</button>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3 relative w-full">
                <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left flex-1">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left -mt-1 block">anass@gmail.com</span>
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm text-left font-bold">Teacher</span>
                        <span class="text-yellow-600 text-sm text-left font-bold">Pending</span>
                    </div>
                </div>
                <div class="absolute top-2 right-2">
                    <button type="button">...</button>
                </div>
            </div>
            <div class="gap-5 flex justify-start items-center mb-3 relative w-full">
                <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF]">
                    <img src="" alt="">
                </div>
                <div class="text-left flex-1">
                    <h3 class="font-semibold">Anass Boutaib</h3>
                    <span class="text-gray-600 text-sm text-left -mt-1 block">anass@gmail.com</span>
                    <div class="flex justify-between">
                        <span class="text-gray-600 text-sm text-left font-bold">Student</span>
                        <span class="text-gray-500 text-sm text-left font-bold">Banned</span>
                    </div>
                </div>
                <div class="absolute top-2 right-2">
                    <button type="button">...</button>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>