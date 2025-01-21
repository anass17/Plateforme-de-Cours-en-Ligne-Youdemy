<?php
    session_start();

    require __DIR__ . '/../../classes/Database.php';
    require __DIR__ . '/../../classes/Security.php';
    require __DIR__ . '/../../classes/Tag.php';
    require __DIR__ . '/../../classes/Category.php';
    require __DIR__ . '/../../classes/User.php';
    require __DIR__ . '/../../classes/Admin.php';

    $authorized_roles = ['admin'];

    $user_row = Security::isAccessTokenValid();

    if (!$user_row || !Security::isAuthorized($user_row['role'], $authorized_roles)) {
        header('Location: /pages/login.php');
        exit;
    }

    $role = $user_row['role'];

    $user = new Admin($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email']);

    $categories = Category::getAllCategories();
    $tags = Tag::getAllTags();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Categories, Tags</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.8.0/tagify.css" />
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
</head>
<body class="bg-blue-100">

    <?php
        include __DIR__ . '/../../inc/header.php';
    ?>

    <div class="py-16 text-center max-w-[1250px] mx-auto px-3">
        <div class="mb-16">
            <h1 class="mb-8 font-semibold text-3xl">Categories</h1>

            <form>
                <div class="relative w-full max-w-xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute top-3 left-3" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    <input type="text" id="search-cats" placeholder="Search for categories ..." class="py-2 px-5 ps-10 rounded w-full mb-10 border border-blue-300 placeholder:text-gray-600 outline-none shadow bg-blue-200">
                </div>
            </form>

            <div class="grid grid-cols-6 *:border *:shadow-md gap-5 *:h-9 *:rounded *:text-sm">

                <button type="button" class="add-category bg-[#00A5CF] border-[#00A5CF]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white mx-auto" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                </button>

                <?php foreach($categories as $category): ?>

                    <button type="button" class="text-gray-700 bg-white category-btn hover:bg-gray-100 font-semibold" data-id="<?php echo $category -> getCategoryId(); ?>" data-name="<?php echo $category -> getCategoryName(); ?>"><?php echo $category -> getCategoryName(); ?></button>
                
                <?php endforeach; ?>

            </div>
        </div>
        <div class="mb-10">
            <h2 class="mb-8 font-semibold text-3xl">Tags</h2>

            <form>
                <div class="relative w-full max-w-xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute top-3 left-3" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/></svg>
                    <input type="text" id="search-tags" placeholder="Search for tags ..." class="py-2 px-5 ps-10 rounded w-full mb-10 border border-blue-300 placeholder:text-gray-600 outline-none shadow bg-blue-200">
                </div>
            </form>

            <div class="grid grid-cols-6 *:border *:shadow-md gap-5 *:h-9 *:rounded *:text-sm">

                <button type="button" class="add-tag bg-[#00A5CF] border-[#00A5CF]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white mx-auto" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                </button>

                <?php foreach($tags as $tag): ?>

                    <button type="button" class="text-gray-700 bg-white tag-btn hover:bg-gray-100 font-semibold" data-id="<?php echo $tag -> getTagId(); ?>" data-name="<?php echo $tag -> getTagName(); ?>"><?php echo $tag -> getTagName(); ?></button>
                
                <?php endforeach; ?>

            </div>
        </div>
    </div>


    <!-- Modals -->

    <div class="bg-black category-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Add New Categories</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form class="" action='/api/CategoryApi.php' method="POST" >
                    <div class="mb-8">
                        <label for="cat_name" class="block mb-2">Categories</label>
                        <input type="text" placeholder="Type and press Enter" class="w-full border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" id="cat_name" name="cat_name">
                    </div>
                    <button type="button" class="rounded bg-[#00A5CF] py-2 w-20 text-white add-categories">Add</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-black edit-category-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Edit Category</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form class="" action='/api/CategoryApi.php' method="POST" >
                    <input type="hidden" name="edit_cat_id" id="edit-cat-id" value="">
                    <div class="mb-5">
                        <label class="block mb-2">Current Name</label>
                        <input type="text" placeholder="Type and press Enter" value="" id="cat-old-name" class="w-full bg-gray-200 border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" disabled>
                    </div>
                    <div class="mb-8">
                        <label for="edit_cat_name" class="block mb-2">New Name</label>
                        <input type="text" placeholder="Type and press Enter" class="w-full border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" id="edit-cat-name" name="edit_cat_name">
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="rounded bg-[#00A5CF] py-2 w-20 text-white edit-category">Edit</button>
                        <button type="button" class="rounded bg-red-500 py-2 w-20 text-white delete-category">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-black tag-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Add New Tags</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form class="" action='/api/CategoryApi.php' method="POST" >
                    <div class="mb-8">
                        <label for="tag_name" class="block mb-2">Tags</label>
                        <input type="text" placeholder="Type and press Enter" class="w-full border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" id="tag_name" name="tag_name">
                    </div>
                    <button type="button" class="rounded bg-[#00A5CF] py-2 w-20 text-white add-tags">Add</button>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-black edit-tag-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Edit Tag</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form class="" action='/api/CategoryApi.php' method="POST" >
                    <input type="hidden" name="edit_tag_id" id="edit-tag-id" value="">
                    <div class="mb-5">
                        <label class="block mb-2">Current Name</label>
                        <input type="text" placeholder="Type and press Enter" value="" id="tag-old-name" class="w-full bg-gray-200 border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" disabled>
                    </div>
                    <div class="mb-8">
                        <label for="edit_tag_name" class="block mb-2">New Name</label>
                        <input type="text" placeholder="Type and press Enter" class="w-full border rounded py-2 px-3 placeholder:text-gray-600 border-gray-400" id="edit-tag-name" name="edit_tag_name">
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="rounded bg-[#00A5CF] py-2 w-20 text-white edit-tag">Edit</button>
                        <button type="button" class="rounded bg-red-500 py-2 w-20 text-white delete-tag">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.8.0/tagify.min.js"></script>
    <script src='/assets/js/script.js'></script>
    <script src='/assets/js/categories.js'></script>
    

</body>
</html>