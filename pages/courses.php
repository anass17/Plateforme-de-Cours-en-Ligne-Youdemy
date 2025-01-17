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
        include __DIR__ . '/../inc/header.php';
    ?>

    <div class="pt-7 px-7 flex gap-8">

        <!-- Side Menu -->

        <div class="w-[30%] rounded-md px-8 py-7 h-screen sticky top-7 border-r-2">
            <div>
                <h3 class="font-semibold text-2xl mb-3">Filter</h3>
                <div class="pl-3">
                    <div class="relative">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4 absolute bottom-2 left-2">!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.<path d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128l95.1 0 11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128l58.2 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-68.9 0L325.8 320l58.2 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-68.9 0-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7-95.1 0-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384 32 384c-17.7 0-32-14.3-32-32s14.3-32 32-32l68.9 0 21.3-128L64 192c-17.7 0-32-14.3-32-32s14.3-32 32-32l68.9 0 11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320l95.1 0 21.3-128-95.1 0z"/></svg> -->
                        <label class="mb-2 font-semibold block">By Tags:</label>
                        <input type="text" placeholder="Search for tags" class="py-1 w-full placeholder:text-gray-600 rounded px-3 bg-[#01a5cf3d] shadow border border-[#01a5cf] outline-none">
                    </div>
                    <div class="pt-3 flex gap-3">
                        <!-- <button type="button" class="text-white px-4 py-1 text-sm rounded bg-[#00A5CF]">HTML</button>
                        <button type="button" class="text-white px-4 py-1 text-sm rounded bg-[#00A5CF]">CSS</button> -->
                    </div>
                    <h4 class="mb-2 font-semibold block">By Date:</h4>
                    <div class="flex gap-4">
                        <div class="w-full">
                            <label>From</label>
                            <input type="date" name="" id="" class="py-1 w-full placeholder:text-gray-600 rounded px-3 bg-[#01a5cf3d] shadow border border-[#01a5cf] outline-none">
                        </div>
                        <div class="w-full">
                            <label>To</label>
                            <input type="date" name="" id="" class="py-1 w-full placeholder:text-gray-600 rounded px-3 bg-[#01a5cf3d] shadow border border-[#01a5cf] outline-none">
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-7">
                <h3 class="font-semibold text-2xl mb-3 ">Courses</h3>
                <div class="*:block *:mb-2 pl-3">
                    <a href="#">Web Development</a>
                    <a href="#">Game Development</a>
                    <a href="#">Artificial Inteligence</a>
                </div>
            </div>
        </div>

        <!-- Courses List -->

        <div class="w-full">

            <!-- Featured -->

            <!-- <div class="flex gap-3">
                <div class="bg-[url('/assets/images/course-bg.jpg')] h-40 rounded-lg">
                    <span class="mt-">Featured</span>
                </div>
            </div> -->

            <!-- Courses -->

            <h1 class="text-3xl mt-5 mb-10 text-center font-semibold">Discover our courses </h1>

            <div class="mb-10">
                <h2 class="text-xl font-semibold">Web Development</h2>
                <span class="text-sm text-gray-600 -mt-1 block">2 Courses</span>

                <div class="mt-5 grid grid-cols-3 gap-3">
                    <a class="bg-[#F0F0F0] rounded-lg border shadow-lg block" href="#">
                        <div class="h-40 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center">

                        </div>
                        <div class="px-5 py-5 text-center">
                            <h3 class="font-semibold text-[#00A5CF] text-lg">Learn Javascript Basics</h3>
                            <div class="flex items-center gap-2 text-[#555555] justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"/></svg>
                                <span class="text-sm">15 Jul 2024</span>
                            </div>
                            <div class="mt-5 flex justify-between items-center">
                                <h4 class="font-medium text-[#6F6F6F]">Anass Boutaib</h4>
                                <span class="text-sm text-[#424242]">15 Subscriptions</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="mb-10">
                <h2 class="text-xl font-semibold">Web Development</h2>
                <span class="text-sm text-gray-700 -mt-1 block">2 Courses</span>

                <div class="mt-5 grid grid-cols-3 gap-3">
                    <a class="bg-[#F0F0F0] rounded-lg border shadow-lg block" href="#">
                        <div class="h-40 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center">

                        </div>
                        <div class="px-5 py-5 text-center">
                            <h3 class="font-semibold text-[#00A5CF] text-lg">Learn Javascript Basics</h3>
                            <div class="flex items-center gap-2 text-[#555555] justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"/></svg>
                                <span class="text-sm">15 Jul 2024</span>
                            </div>
                            <div class="mt-5 flex justify-between items-center">
                                <h4 class="font-medium text-[#6F6F6F]">Anass Boutaib</h4>
                                <span class="text-sm text-[#424242]">15 Subscriptions</span>
                            </div>
                        </div>
                    </a>
                    <a class="bg-[#F0F0F0] rounded-lg border shadow-lg block" href="#">
                        <div class="h-40 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center">

                        </div>
                        <div class="px-5 py-5 text-center">
                            <h3 class="font-semibold text-[#00A5CF] text-lg">Learn Javascript Basics</h3>
                            <div class="flex items-center gap-2 text-[#555555] justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"/></svg>
                                <span class="text-sm">15 Jul 2024</span>
                            </div>
                            <div class="mt-5 flex justify-between items-center">
                                <h4 class="font-medium text-[#6F6F6F]">Anass Boutaib</h4>
                                <span class="text-sm text-[#424242]">15 Subscriptions</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>

</body>
</html>