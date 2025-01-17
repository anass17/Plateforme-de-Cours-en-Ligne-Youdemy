<?php
    session_start();

    require __DIR__ . '/../../classes/Database.php';
    require __DIR__ . '/../../classes/Security.php';

    $role = "";

    Security::createCSRFToken();

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

    <div class="pt-7 px-7 flex gap-8 max-w-[1250px] mx-auto">

        <!-- Courses List -->

        <div class="w-full">

            <!-- My Courses -->

            <h1 class="text-3xl mt-5 mb-10 text-center font-semibold">Your Uploaded Courses</h1>

            <button type="button" class="bg-[#00A5CF] open-add-modal-btn text-white px-6 py-2 rounded font-semibold mb-8 gap-4 flex items-center mx-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                <span>Add New Course</span>
            </button>

            <div class="mb-10">
                <div class="mt-5 grid grid-cols-3 gap-5">
                    <a class="bg-[#F0F0F0] rounded-lg border shadow-lg block" href="#">
                        <div class="h-48 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center">

                        </div>
                        <div class="px-6 py-7 text-center">
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
                        <div class="h-48 rounded-lg bg-[url('/assets/images/course-bg.jpg')] bg-cover bg-center">

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

    <!-- Modal -->

    <div class="bg-black add-course-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Add New Course</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form action="/validation/add-course.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $_SESSION["CSRF_token"]; ?>" name="CSRF_token">

                    <div class="mb-4">
                        <p class="mb-2">Background</p>
                        <label for="form-course-background" class="file-label mb-2 h-20 bg-blue-200 border border-blue-300 text-gray-800 rounded flex gap-6 text-lg justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-6 h-6" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>    
                            Upload an Image
                        </label>
                        <input type="file" id="form-course-background" name="course-background" class="hidden"></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-title" class="block mb-2">Title *</label>
                        <input type="text" placeholder="course Title" id="form-course-title" name="course-title" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100 placeholder:text-gray-500">
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-description" class="block mb-2">Content *</label>
                        <textarea type="text" placeholder="course Body" id="form-course-description" name="course-description" class="w-full px-4 py-2 rounded border outline-none h-36 resize-y border-blue-200 bg-gray-100 placeholder:text-gray-500"></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-category" class="block mb-2">Category *</label>
                        <select name="course-category" id="form-course-category" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100">
                            <option value="">Select a category</option>
                            <option value="1">Technology</option>
                            <option value="2">Sports</option>
                        </select>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <label for="form-course-tags" class="block mb-2">Tags <span class="ml-5 text-gray-500">[<span class="tags-count">0</span>]</span></label>
                            <button type="button" class="tags-toggle transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 320 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>
                            </button>
                        </div>
                        <div class="">
                            <div class="*:text-sm grid grid-cols-3 gap-3 *:rounded *:border *:shadow *:py-1.5 overflow-auto no-scrolling tags-container transition-all" style="height: 0px;">
                                
                            </div>
                        </div>
                        <input type="hidden" id="form-course-tags" name="course-tags" class="w-full px-3 py-2 rounded border outline-none border-blue-200 bg-gray-100 placeholder:text-gray-500">
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-type" class="block mb-2">Course Type *</label>
                        <select name="course-type" id="form-course-type" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100">
                            <option value="">Select a type</option>
                            <option value="video">Video</option>
                            <option value="document">Document</option>
                        </select>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2">Course File *</p>
                        <label for="form-course-file" class="file-label mb-2 h-20 bg-blue-200 border border-blue-300 text-gray-800 rounded flex gap-6 text-lg justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-6 h-6" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>    
                            Upload a File
                        </label>
                        <input type="file" id="form-course-file" name="course-file" class="hidden"></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <button type="submit" class="h-10 w-32 bg-[#00A5CF] text-white block rounded submit-btn">POST</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/my-courses.js"></script>

</body>
</html>