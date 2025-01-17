<?php
    $role = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Categories</title>
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
        <h1 class="mb-12 font-semibold text-4xl">Categories & Tags</h1>

        <button type="button" class="bg-[#00A5CF] text-white px-6 py-2 rounded font-semibold mb-10 gap-4 flex items-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
            <span>Add New Category</span>
        </button>

        <div class="grid grid-cols-3 gap-14">
            <div class="">
                <h2 class="font-semibold mb-4 text-md">Web Development</h2>
                <div class="grid grid-cols-3 *:border *:shadow-md gap-5 *:h-9 *:rounded">
                    <button type="button">HTML</button>
                    <button type="button">CSS</button>
                    <button type="button">JS</button>
                    <button type="button" class="add-category bg-[#00A5CF] border-[#00A5CF]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white mx-auto" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                    </button>
                </div>
            </div>
            <div class="">
                <h2 class="font-semibold mb-4 text-md">Game Development</h2>
                <div class="grid grid-cols-3 *:border *:shadow-md gap-5 *:h-9 *:rounded">
                    <button type="button">Unity</button>
                    <button type="button">C#</button>
                    <button type="button" class="add-category bg-[#00A5CF] border-[#00A5CF]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white mx-auto" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>