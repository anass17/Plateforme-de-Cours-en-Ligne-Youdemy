<?php

    session_start();

    require __DIR__ . '/../../classes/Database.php';
    require __DIR__ . '/../../classes/Security.php';
    require __DIR__ . '/../../classes/Category.php';
    require __DIR__ . '/../../classes/Course.php';
    require __DIR__ . '/../../classes/VideoCourse.php';
    require __DIR__ . '/../../classes/DocumentCourse.php';
    require __DIR__ . '/../../classes/User.php';
    require __DIR__ . '/../../classes/Student.php';
    require __DIR__ . '/../../classes/Teacher.php';
    require __DIR__ . '/../../classes/Admin.php';
    require __DIR__ . '/../../classes/Helpers.php';

    $authorized_roles = ['admin'];

    $user_row = Security::isAccessTokenValid();

    if (!$user_row) {
        header('Location: /pages/login.php');
        exit;
    }

    $role = $user_row['role'];

    $user = new Admin($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role'], $user_row['image_url']);

    Security::authorizedAccess($user, $authorized_roles);

    $usersList = Admin::getUsersList();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Playwrite+IN:wght@100..400&display=swap" rel="stylesheet">
</head>
<body class="bg-blue-100">

    <?php
        include __DIR__ . '/../../inc/header.php';
    ?>

    <style>
        .active-tab {
            background-color: #00A5CF;
            border-color: #00A5CF;
            color: white;
        }
        .active-tab:hover {
            background-color: #00A5CF;
        }
    </style>

    <div class="py-16 text-center max-w-[1250px] mx-auto px-3">
        <h1 class="mb-12 font-semibold text-4xl">Users</h1>

        <div class="flex filter-tabs gap-3 *:rounded *:w-24 *:h-9 *:border justify-center mb-16 *:shadow *:bg-white text-gray-600 *:font-semibold *:text-sm hover:*:bg-gray-100 transition-colors">
            <button type="button" data-filter="All" class="active-tab">All</button>
            <button type="button" data-filter="Admin" class="">Admins</button>
            <button type="button" data-filter="Teacher" class="">Teachers</button>
            <button type="button" data-filter="Student" class="">Students</button>
            <button type="button" data-filter="active" class="">Active</button>
            <button type="button" data-filter="pending" class="">Pending</button>
            <button type="button" data-filter="banned" class="">Banned</button>
        </div>

        <div class="grid grid-cols-3 gap-6">

            <?php foreach($usersList as $user): ?>

                <div class="gap-5 flex justify-start items-center relative w-full bg-white px-5 shadow py-5 rounded info user">
                    <div class="rounded-full w-16 h-16 border-2 border-[#00A5CF] overflow-hidden">
                        <img src="<?php echo $user -> getImageUrl(); ?>" class="w-full h-full" alt="">
                    </div>
                    <div class="text-left flex-1">
                        <h3 class="font-semibold"><?php echo $user -> getFullName(); ?></h3>
                        <span class="text-gray-600 text-sm text-left -mt-1 block"><?php echo $user -> getEmail(); ?></span>
                        <div class="flex justify-between status-info">
                            <span class="text-gray-600 text-sm text-left font-bold user-role"><?php echo ucfirst($user -> getRole()); ?></span>
                            
                            <!-- Status -->

                            <?php if ($user -> getStatus() == "active"): ?>
                                <span class="text-green-700 text-sm text-left font-bold"><?php echo $user -> getStatus(); ?></span>
                            <?php elseif ($user -> getStatus() == 'pending'): ?>
                                <span class="text-yellow-700 text-sm text-left font-bold"><?php echo $user -> getStatus(); ?></span>
                            <?php else: ?>
                                <span class="text-gray-700 text-sm text-left font-bold"><?php echo $user -> getStatus(); ?></span>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                    
                    <?php if ($user -> getRole() != 'admin'): ?>
                    
                        <div class="absolute top-2 right-5">
                            <button type="button" class="actions-btn">...</button>
                            <div class=" absolute top-8 bg-gray-100 hidden -right-2 border shadow-md rounded py-4 px-5 w-48 flex-col gap-3 text-sm" data-id="<?php echo $user -> getUserId(); ?>">
                                
                                <?php if ($user -> getStatus() == "pending"): ?>
                                <button type="button" class="flex gap-2 items-center action-btn" data-status="active">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-green-700" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM625 177L497 305c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L591 143c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg>
                                    <span>Approve Teacher</span>
                                </button>
                                <?php elseif ($user -> getStatus() == "banned"): ?>
                                    <button type="button" class="flex gap-2 items-center action-btn" data-status="active">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-green-700" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M142.9 142.9c-17.5 17.5-30.1 38-37.8 59.8c-5.9 16.7-24.2 25.4-40.8 19.5s-25.4-24.2-19.5-40.8C55.6 150.7 73.2 122 97.6 97.6c87.2-87.2 228.3-87.5 315.8-1L455 55c6.9-6.9 17.2-8.9 26.2-5.2s14.8 12.5 14.8 22.2l0 128c0 13.3-10.7 24-24 24l-8.4 0c0 0 0 0 0 0L344 224c-9.7 0-18.5-5.8-22.2-14.8s-1.7-19.3 5.2-26.2l41.1-41.1c-62.6-61.5-163.1-61.2-225.3 1zM16 312c0-13.3 10.7-24 24-24l7.6 0 .7 0L168 288c9.7 0 18.5 5.8 22.2 14.8s1.7 19.3-5.2 26.2l-41.1 41.1c62.6 61.5 163.1 61.2 225.3-1c17.5-17.5 30.1-38 37.8-59.8c5.9-16.7 24.2-25.4 40.8-19.5s25.4 24.2 19.5 40.8c-10.8 30.6-28.4 59.3-52.9 83.8c-87.2 87.2-228.3 87.5-315.8 1L57 457c-6.9 6.9-17.2 8.9-26.2 5.2S16 449.7 16 440l0-119.6 0-.7 0-7.6z"/></svg>
                                        <span>Activate Account</span>
                                    </button>
                                <?php elseif ($user -> getStatus() == "active"): ?>
                                    <button type="button" class="flex gap-2 items-center action-btn" data-status="banned">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-700" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M367.2 412.5L99.5 144.8C77.1 176.1 64 214.5 64 256c0 106 86 192 192 192c41.5 0 79.9-13.1 111.2-35.5zm45.3-45.3C434.9 335.9 448 297.5 448 256c0-106-86-192-192-192c-41.5 0-79.9 13.1-111.2 35.5L412.5 367.2zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/></svg>
                                        <span>Ban Account</span>
                                    </button>
                                <?php endif; ?>
                                <button type="button" class="flex gap-2 items-center delete-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-700" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg>
                                    <span>Delete Account</span>
                                </button>
                            </div>
                        </div>
                    
                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>
    </div>
    
    <script src='/assets/js/script.js'></script>
    <script src='/assets/js/users.js'></script>

</body>
</html>