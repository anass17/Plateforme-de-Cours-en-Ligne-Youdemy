<?php
    $role = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Course</title>
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

        <div class="w-[35%] rounded-lg bg-gray-200 px-8 py-7 h-screen top-7 text-center border shadow-lg">
            <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF] mx-auto">
                <img src="" alt="">
            </div>
            <h3 class="font-semibold text-md text-gray-800">Anass Boutaib</h3>
            <span class="text-sm text-[#696969]">Member Since: 15 Jul 2024</span>
            <div class="h-px w-44 mx-auto my-4 bg-gray-300"></div>
            <p class="mb-5">Professor at UM6P</p>
            <p class="text-gray-700">vel optio nemo dolores reprehenderit minus quod Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla labo riosam</p>
            <div class="mt-6">
                <h4 class="font-semibold mb-3 text-md">Statistics</h4>
                <ul class="*:mb-2">
                    <li>12 Courses</li>
                    <li>134 Subscriptions</li>
                    <li>1052 Followers</li>
                </ul>
            </div>
            <div class="flex justify-center items-center mt-8 flex-col">
                <button type="button" class="flex items-center gap-3 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-[#00A5CF]" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                    <span class="text-[#00A5CF] font-semibold">Follow</span>
                </button>
                <button type="button" class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-[#00A5CF]" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32L0 64 0 368 0 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 64.3-16.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-247.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L64 48l0-16z"/></svg>
                    <span class="text-[#00A5CF] font-semibold">Report</span>
                </button>
            </div>
        </div>

        <!-- Courses List -->

        <div class="w-full">

            <!-- Courses -->

            <div class="mb-10 px-5">
                <div class="h-72 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center mb-6">

                </div>
                <div>
                    <div class="flex justify-between items-center mb-10 px-10">
                        <div>
                            <h1 class="text-[#00A5CF] text-2xl font-semibold">The ultimate course of PHP</h1>
                            <div class="flex gap-3 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"/></svg>
                                <span>15 Jul 2018</span>
                            </div>
                        </div>
                        <span>132 Subscriptions</span>
                    </div>
                    <p class="text-gray-600 mb-8">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla laboriosam? Veniam dolor asperiores perferendis iure vel optio nemo dolores reprehenderit minus quodLorem ipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla laboriosam? Veniam dolor asperiores perferendis iure vel optio nemo dolores reprehenderit minuipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla laboriosam? Veniam dolor asperiores perferendis iure vel optio nemo dolores reprehenderit minus quod.</p>
                    <button type="button" class="bg-[#00A5CF] text-white px-6 py-2 rounded font-semibold mr-2">Subscribe</button>
                    <button type="button" class="bg-[#4EC300] text-white px-6 py-2 rounded font-semibold mr-2">Leave a review</button>
                </div>
                <div class="h-px w-96 my-10 mx-auto bg-gray-300"></div>
                <div>
                    <h2 class="font-semibold text-md mb-5">5 Reviews</h2>
                    <div class="mb-7">
                        <div class="gap-3 flex justify-start items-center mb-2">
                            <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF]">
                                <img src="" alt="">
                            </div>
                            <div>
                                <h3 class="font-semibold">Anass Boutaib <span class="px-3 py-1 rounded bg-gray-800 text-white inline-block ml-3 text-sm">Owner</span></h3>
                                <span class="text-gray-600 text-sm">2 days ago</span>
                            </div>
                        </div>
                        <div class="flex gap-2 mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-yellow-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-yellow-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        </div>
                        <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla laboriosam? Veniam dolor asperiores perferendis iure vel optio nemo dolores</p>
                    </div>
                    <div class="mb-7">
                        <div class="gap-3 flex justify-start items-center mb-2">
                            <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF]">
                                <img src="" alt="">
                            </div>
                            <div>
                                <h3 class="font-semibold">Anass Boutaib <span class="px-3 py-1 rounded bg-gray-800 text-white inline-block ml-3 text-sm">Owner</span></h3>
                                <span class="text-gray-600 text-sm">2 days ago</span>
                            </div>
                        </div>
                        <div class="flex gap-2 mb-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-yellow-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-yellow-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        </div>
                        <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed maxime dolores nulla laboriosam? Veniam dolor asperiores perferendis iure vel optio nemo dolores</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
</html>