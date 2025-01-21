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

    $authorized_roles = ['student'];

    $user_row = Security::isAccessTokenValid();

    if (!$user_row) {
        header('Location: /pages/login.php');
        exit;
    }

    $role = $user_row['role'];
    $user = new Student($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role'], $user_row['image_url'], $user_row['register_date'], $user_row['status'], $user_row['title'], $user_row['bio']);

    Security::authorizedAccess($user, $authorized_roles);
    
    $courses = $user -> loadMySubscriptions();

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
        include __DIR__ . '/../../inc/header.php';
    ?>

    <div class="pe-7 gap-8 grid grid-cols-[30%_1fr]">

        <!-- Side Menu -->

        <div class="rounded-md px-7 py-10 h-screen sticky top-0 border-r-2 text-center">
            <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF] mx-auto overflow-hidden">
                <img src="<?php echo $user -> getImageUrl(); ?>" alt="">
            </div>
            <h3 class="font-semibold text-xl text-gray-800 -mb-1"><?php echo $user -> getFullName(); ?></h3>
            <span class="text-xs text-[#696969]">Member Since: <?php echo Helpers::format_date($user -> getRegisterDate()); ?></span>

            <div class="mt-6">
                <h4 class="font-semibold mb-3 text-md">Statistics</h4>
                <ul class="*:mb-2">
                    <li>15 Subscriptions</li>
                    <li>12 Following</li>
                </ul>
            </div>
        </div>

        <!-- Courses List -->

        <div class="w-full">

            <?php if (isset($_SESSION['errors'])): ?>
                <div class="px-5 py-4 rounded border border-red-500 bg-red-100 mb-7 mt-10 text-center">
                    <ul>
                        <?php
                            foreach($_SESSION["errors"] as $error) {
                                echo "<li>$error</li>";
                            }
                            session_destroy();
                        ?>
                    </ul>
                </div>
            <?php elseif (isset($_SESSION['success'])): ?>
                <div class="px-5 py-4 rounded border border-green-500 bg-green-100 mb-7 mt-10 text-center">
                    <p><?php echo $_SESSION['success']; ?></p>
                </div>
                <?php session_destroy(); ?>
            <?php endif; ?>

            <!-- Courses -->

            <div class="my-10 px-5">

                <div class="mt-5 grid grid-cols-3 gap-3">
                        
                    <?php foreach($courses as $course): ?>
                    
                    <a class="bg-[#F0F0F0] rounded-lg border group shadow-lg block" href="<?php echo "/pages/view.php?id={$course -> getCourseId()}"; ?>">
                        <div class="h-40 rounded-lg bg-cover bg-center relative" style="<?php echo "background-image: url('{$course -> getImagePath()}')"; ?>">
                            <div class="absolute top-3 left-3 bg-white group-hover:bg-opacity-100 transition-colors bg-opacity-65 w-6 h-6 rounded flex items-center justify-center">
                                <?php if ($course -> getType() == "Video"): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9l0-176c0-8.7 4.7-16.7 12.3-20.9z"/></svg>
                                <?php elseif ($course -> getType() == "Document"): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 464l48 0 0 48-48 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 304l-48 0 0-144-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"/></svg>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="px-5 py-5">
                            <div class="flex items-center gap-2 text-[#555555] text-[12px]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="relative w-[14px]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                <span class="text-sm"><?php echo Helpers::format_date($course -> getPublishDate()); ?></span>
                            </div>
                            <h3 class="font-semibold text-[#00A5CF] text-lg"><?php echo $course -> getTitle(); ?></h3>
                            <div class="mt-5 flex justify-between items-center">
                                <h4 class="font-medium text-[#6F6F6F] flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l293.1 0c-3.1-8.8-3.7-18.4-1.4-27.8l15-60.1c2.8-11.3 8.6-21.5 16.8-29.7l40.3-40.3c-32.1-31-75.7-50.1-123.9-50.1l-91.4 0zm435.5-68.3c-15.6-15.6-40.9-15.6-56.6 0l-29.4 29.4 71 71 29.4-29.4c15.6-15.6 15.6-40.9 0-56.6l-14.4-14.4zM375.9 417c-4.1 4.1-7 9.2-8.4 14.9l-15 60.1c-1.4 5.5 .2 11.2 4.2 15.2s9.7 5.6 15.2 4.2l60.1-15c5.6-1.4 10.8-4.3 14.9-8.4L576.1 358.7l-71-71L375.9 417z"/></svg>
                                    <span class="text-sm"><?php echo $course -> getTeacher() -> getFullName(); ?></span>
                                </h4>
                                <span class="text-sm text-[#424242] flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                                    <span><?php echo $course -> getEnrollementsCount(); ?></span>
                                </span>
                            </div>
                        </div>
                    </a>

                    <?php endforeach; ?>

                </div>
                
            </div>

        </div>
    </div>

    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/view.js"></script>

</body>
</html>