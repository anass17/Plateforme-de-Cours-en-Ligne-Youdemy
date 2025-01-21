<?php
    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/Category.php';
    require __DIR__ . '/../classes/Review.php';
    require __DIR__ . '/../classes/Course.php';
    require __DIR__ . '/../classes/VideoCourse.php';
    require __DIR__ . '/../classes/DocumentCourse.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Student.php';
    require __DIR__ . '/../classes/Teacher.php';
    require __DIR__ . '/../classes/Admin.php';
    require __DIR__ . '/../classes/Helpers.php';

    $user_row = Security::isAccessTokenValid();

    $role = "";

    if ($user_row) {

        $role = $user_row['role'];

        if ($role == "teacher") {
            $user = new Teacher($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role']);
        } else if ($role == "student") {
            $user = new Student($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role']);
        } else if ($role == "admin") {
            $user = new Admin($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role']);
        }
    }

    if (!isset($_GET['id'])) {
        header('Location: /pages/courses.php');
        exit;
    }

    $course_details = Course::getCourse($_GET['id']);

    if (!$course_details) {
        header('Location: /pages/courses.php');
        exit;
    }

    $categories = Category::getAllCategories();

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

    <div class="pe-7 gap-8 grid grid-cols-[35%_1fr]">

        <!-- Side Menu -->

        <div class="rounded-md px-7 py-10 h-screen sticky top-0 border-r-2 text-center">
            <div class="rounded-full mb-2 w-16 h-16 border-2 border-[#00A5CF] mx-auto overflow-hidden">
                <img src="<?php echo $course_details -> getTeacher() ->getImageUrl(); ?>" alt="">
            </div>
            <h3 class="font-semibold text-xl text-gray-800 -mb-1"><?php echo $course_details -> getTeacher() -> getFullName(); ?></h3>
            <span class="text-xs text-[#696969]">Member Since: <?php echo Helpers::format_date($course_details -> getTeacher() -> getRegisterDate()); ?></span>
            <div class="h-px w-52 mx-auto my-4 bg-gray-300"></div>
            <p class="mb-5"><?php echo $course_details -> getTeacher() -> getTitle(); ?></p>
            <p class="text-gray-700"><?php echo $course_details -> getTeacher() -> getBio(); ?></p>
            <div class="mt-6">
                <h4 class="font-semibold mb-3 text-md">Statistics</h4>
                <ul class="*:mb-2">
                    <li>12 Courses</li>
                    <li>134 Subscriptions</li>
                    <li>1052 Followers</li>
                </ul>
            </div>
            
            <?php if ($role != ""): ?>

                <div class="flex justify-center items-center mt-8 flex-col">
                    <button type="button" class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-[#00A5CF]" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3zM504 312l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z"/></svg>
                        <span class="text-[#00A5CF] font-semibold">Follow</span>
                    </button>
                    <button type="button" class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-[#00A5CF]" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 32C64 14.3 49.7 0 32 0S0 14.3 0 32L0 64 0 368 0 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 64.3-16.1c41.1-10.3 84.6-5.5 122.5 13.4c44.2 22.1 95.5 24.8 141.7 7.4l34.7-13c12.5-4.7 20.8-16.6 20.8-30l0-247.7c0-23-24.2-38-44.8-27.7l-9.6 4.8c-46.3 23.2-100.8 23.2-147.1 0c-35.1-17.6-75.4-22-113.5-12.5L64 48l0-16z"/></svg>
                        <span class="text-[#00A5CF] font-semibold">Report</span>
                    </button>
                </div>

            <?php endif; ?>
                
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

                <!-- Course Background -->

                <div class="h-80 rounded-lg bg-cover relative bg-center mb-6" style="<?php echo "background-image: url('{$course_details -> getImagePath()}')"; ?>">
                
                    <!-- Subscription Badge -->

                    <?php if ($role == 'student' && $course_details -> is_subscribed($user -> getUserId())): ?>

                        <div class="absolute top-3 left-3 rounded px-4 py-2 bg-blue-100 text-gray-800 text-sm font-semibold flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 fill-gray-800" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/></svg>
                            <span>Subscribed</span>
                        </div>

                    <?php endif; ?>

                    <?php if ($role == 'admin' || ($role == 'teacher') && $user -> getUserId() == $course_details -> getTeacher() -> getUserId()): ?>

                        <div class="absolute top-3 right-4">
                            <button type="button" class="actions-btn w-7 h-7 bg-white bg-opacity-0 hover:bg-opacity-70 flex justify-center items-center rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M8 256a56 56 0 1 1 112 0A56 56 0 1 1 8 256zm160 0a56 56 0 1 1 112 0 56 56 0 1 1 -112 0zm216-56a56 56 0 1 1 0 112 56 56 0 1 1 0-112z"/></svg>
                            </button>

                            <div class="absolute top-8 bg-gray-100 hidden -right-2 border shadow-md rounded py-4 px-5 w-48 flex-col gap-3 text-sm">
                                
                                <?php if ($role == 'admin'): ?>

                                    <button type="button" class="flex gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 80L0 229.5c0 17 6.7 33.3 18.7 45.3l176 176c25 25 65.5 25 90.5 0L418.7 317.3c25-25 25-65.5 0-90.5l-176-176c-12-12-28.3-18.7-45.3-18.7L48 32C21.5 32 0 53.5 0 80zm112 32a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                                        <span>Insert Tags</span>
                                    </button>

                                <?php else: ?>

                                    <button type="button" class="flex gap-2 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-blue-600" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/></svg>
                                        <span>Update Course</span>
                                    </button>

                                <?php endif; ?>

                                <button type="button" class="flex gap-2 items-center delete-course-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-red-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0L284.2 0c12.1 0 23.2 6.8 28.6 17.7L320 32l96 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 96C14.3 96 0 81.7 0 64S14.3 32 32 32l96 0 7.2-14.3zM32 128l384 0 0 320c0 35.3-28.7 64-64 64L96 512c-35.3 0-64-28.7-64-64l0-320zm96 64c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16l0 224c0 8.8 7.2 16 16 16s16-7.2 16-16l0-224c0-8.8-7.2-16-16-16z"/></svg>
                                    <span>Delete Course</span>
                                </button>

                            </div>
                        </div>

                    <?php endif; ?>

                </div>

                <div class="px-7">
                    <div class="flex justify-between items-center mb-10">
                        <div>
                            <div class="flex gap-3 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="relative w-[14px]" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/></svg>
                                <span class="text-sm"><?php echo Helpers::format_date($course_details -> getPublishDate()); ?></span>
                            </div>
                            <h1 class="text-[#00A5CF] text-2xl font-semibold"><?php echo $course_details -> getTitle(); ?></h1>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex gap-2 items-center">

                                <?php if($course_details -> getType() == "Video"): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M464 256A208 208 0 1 0 48 256a208 208 0 1 0 416 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zM188.3 147.1c7.6-4.2 16.8-4.1 24.3 .5l144 88c7.1 4.4 11.5 12.1 11.5 20.5s-4.4 16.1-11.5 20.5l-144 88c-7.4 4.5-16.7 4.7-24.3 .5s-12.3-12.2-12.3-20.9l0-176c0-8.7 4.7-16.7 12.3-20.9z"/></svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M64 464l48 0 0 48-48 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 304l-48 0 0-144-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16zM176 352l32 0c30.9 0 56 25.1 56 56s-25.1 56-56 56l-16 0 0 32c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-48 0-80c0-8.8 7.2-16 16-16zm32 80c13.3 0 24-10.7 24-24s-10.7-24-24-24l-16 0 0 48 16 0zm96-80l32 0c26.5 0 48 21.5 48 48l0 64c0 26.5-21.5 48-48 48l-32 0c-8.8 0-16-7.2-16-16l0-128c0-8.8 7.2-16 16-16zm32 128c8.8 0 16-7.2 16-16l0-64c0-8.8-7.2-16-16-16l-16 0 0 96 16 0zm80-112c0-8.8 7.2-16 16-16l48 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 32 32 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-32 0 0 48c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-64 0-64z"></path></svg>
                                <?php endif; ?>

                                <span><?php echo $course_details -> getType(); ?></span>
                            </div>
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M264.5 5.2c14.9-6.9 32.1-6.9 47 0l218.6 101c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 149.8C37.4 145.8 32 137.3 32 128s5.4-17.9 13.9-21.8L264.5 5.2zM476.9 209.6l53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 277.8C37.4 273.8 32 265.3 32 256s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0l152-70.2zm-152 198.2l152-70.2 53.2 24.6c8.5 3.9 13.9 12.4 13.9 21.8s-5.4 17.9-13.9 21.8l-218.6 101c-14.9 6.9-32.1 6.9-47 0L45.9 405.8C37.4 401.8 32 393.3 32 384s5.4-17.9 13.9-21.8l53.2-24.6 152 70.2c23.4 10.8 50.4 10.8 73.8 0z"/></svg>
                                <span><?php echo $course_details -> getCategory() -> getCategoryName(); ?></span>
                            </div>
                            <div class="flex gap-2 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-gray-600" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M219.3 .5c3.1-.6 6.3-.6 9.4 0l200 40C439.9 42.7 448 52.6 448 64s-8.1 21.3-19.3 23.5L352 102.9l0 57.1c0 70.7-57.3 128-128 128s-128-57.3-128-128l0-57.1L48 93.3l0 65.1 15.7 78.4c.9 4.7-.3 9.6-3.3 13.3s-7.6 5.9-12.4 5.9l-32 0c-4.8 0-9.3-2.1-12.4-5.9s-4.3-8.6-3.3-13.3L16 158.4l0-71.8C6.5 83.3 0 74.3 0 64C0 52.6 8.1 42.7 19.3 40.5l200-40zM111.9 327.7c10.5-3.4 21.8 .4 29.4 8.5l71 75.5c6.3 6.7 17 6.7 23.3 0l71-75.5c7.6-8.1 18.9-11.9 29.4-8.5C401 348.6 448 409.4 448 481.3c0 17-13.8 30.7-30.7 30.7L30.7 512C13.8 512 0 498.2 0 481.3c0-71.9 47-132.7 111.9-153.6z"/></svg>
                                <span><?php echo $course_details -> getEnrollementsCount(); ?></span>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-8"><?php echo $course_details -> getDescription(); ?></p>

                    <!-- Course Buttons -->
                    
                    <?php if ($role == 'student'): ?>

                        <?php if (!$course_details -> is_subscribed($user -> getUserId())): ?>

                            <form action="/validation/subscribe.php" method="POST">
                                <input type="hidden" value="<?php echo $_GET['id']; ?>" name="course-id">
                                <button type="submit" class="bg-[#00A5CF] text-white px-6 py-2 rounded font-semibold mr-2">Subscribe</button>
                            </form>

                        <?php else: ?>

                            <button type="button" class="bg-[#00A5CF] text-white px-6 py-2 rounded font-semibold mr-2 open-course-modal">Open Course</button>
                            
                            <?php if(!$course_details -> hasPlacedReview($user -> getUserId())): ?>
                            
                                <button type="button" class="bg-[#4EC300] text-white px-6 py-2 rounded font-semibold mr-2 add-review-btn">Leave a review</button>

                            <?php endif; ?>

                        <?php endif; ?>

                    <?php endif; ?>

                    <!-- For Visitor -->

                    <?php if ($role == ""): ?>

                        <button type="button" class="bg-[#00A5CF] text-white px-6 py-2 rounded font-semibold mr-2 subscribe-login">Subscribe</button>

                    <?php endif; ?>

                </div>
                <div class="h-px w-96 my-10 mx-auto bg-gray-300"></div>
                <div>
                    <h2 class="font-semibold text-md mb-5"><?php echo count($course_details -> getCourseReviews()); ?> Review(s)</h2>

                    <!-- Review -->
                    
                    <?php foreach ($course_details -> getCourseReviews() as $review): ?>

                        <?php 
                        
                            $reviewer = new Student();

                            $reviewer -> loadUser($review -> getReviewAuthorId());
                        
                        ?>

                        <div class="mb-7">
                            <div class="gap-3 flex justify-start items-center mb-2">
                                <div class="rounded-full w-16 h-16 border-2 border-[#00A5CF] overflow-hidden">
                                    <img src="<?php echo $reviewer -> getImageUrl(); ?>" alt="">
                                </div>
                                <div>
                                    <h3 class="font-semibold"><?php echo $reviewer -> getFullName(); ?></h3>
                                    <span class="text-gray-600 text-sm"><?php echo Helpers::format_date($review -> getReviewDate()) ?></span>
                                </div>
                            </div>
                            <div class="flex gap-2 mb-5">

                                <?php for ($i = 0; $i < $review -> getReviewRating(); $i++): ?>
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-yellow-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                
                                <?php endfor; ?>

                                <?php for ($i = 0; $i < 5 - $review -> getReviewRating(); $i++): ?>
                                
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                                
                                <?php endfor; ?>

                            </div>
                            <p class="text-gray-700"><?php echo $review -> getReviewContent(); ?></p>
                        </div>
                        
                    <?php endforeach; ?>

                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->

    <div class="bg-black view-course-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-3xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">View Course</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <?php $course_details -> displayCourse(); ?>

        </div>
    </div>

    <div class="bg-black confirm-delete-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Confirm Delete</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>
                
                <div class="py-5 px-7">
                <p class="mb-8">Do you really want to delete this course? All reviews and subscriptions will also be deleted.</p>
                <form class="" action='/validation/delete-course.php' method="POST" >
                    <input type="hidden" name="course-id" id="course-id" value="<?php echo $course_details -> getCourseId(); ?>">
                    <div class="flex gap-2">
                        <button type="submit" class="rounded bg-red-500 py-2 w-28 text-white">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Login to Subscribe Modal -->

    <div class="bg-black subscribe-login-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Subscribe to course</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-10 px-7">
                <p class="mb-8 text-center">Please log in to continue and access all the course content.</p>
                <div class="flex gap-2 justify-center">
                    <a href="/pages/login.php" class="rounded bg-[#00A5CF] py-2 w-28 text-white text-center">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Review -->

    <div class="bg-black review-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Leave Review</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-10 px-7">
                <form  action='/validation/add-review.php' method="POST" >
                    <input type="hidden" name="course-id" id="course-id" value="<?php echo $course_details -> getCourseId(); ?>">
                    <div class="mb-5">
                        <label class="block mb-1">Rating</label>
                        <div class="flex gap-2 stars *:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-300" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/></svg>
                        </div>
                        <input type="hidden" name="rating-input" id="rating-input">
                    </div>
                    <div class="mb-5">
                        <label class="block mb-1">Review</label>
                        <textarea name="course-review" id="course-id" placeholder="Write Message" class="outline-none search-input h-28 py-1.5 px-4 placeholder:text-gray-600 rounded bg-[#00A5CF20] border border-[#00A5CF] w-full"></textarea>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="rounded bg-[#00A5CF] py-2 w-28 text-white font-semibold">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <div class="bg-black modify-course-modal bg-opacity-70 backdrop-blur-sm fixed top-0 left-0 z-50 justify-center items-center w-full h-screen hidden">
        <div class="bg-white w-full max-w-xl rounded max-h-[650px] overflow-auto shadow-lg no-scrolling">
                
            <div class="px-7 py-4 flex justify-between items-center border-b border-gray-300">
                <h2 class="text-lg font-bold text-gray-700">Edit Course Details</h2>
                <button type="button" class="font-semibold text-red-500 text-xl close-btn">X</button>
            </div>

            <div class="py-5 px-7">
                <form action="/validation/edit-course.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo $_SESSION["CSRF_token"]; ?>" name="CSRF_token">

                    <div class="mb-4">
                        <p class="mb-1 text-[15px]">Background</p>
                        <label for="form-course-background" class="file-label mb-2 h-20 bg-blue-200 border border-blue-300 text-gray-800 rounded flex gap-6 text-lg justify-center items-center cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 fill-gray-800" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M448 80c8.8 0 16 7.2 16 16l0 319.8-5-6.5-136-176c-4.5-5.9-11.6-9.3-19-9.3s-14.4 3.4-19 9.3L202 340.7l-30.5-42.7C167 291.7 159.8 288 152 288s-15 3.7-19.5 10.1l-80 112L48 416.3l0-.3L48 96c0-8.8 7.2-16 16-16l384 0zM64 32C28.7 32 0 60.7 0 96L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-320c0-35.3-28.7-64-64-64L64 32zm80 192a48 48 0 1 0 0-96 48 48 0 1 0 0 96z"/></svg>
                            Upload an Image
                        </label>
                        <input type="file" id="form-course-background" name="course-background" class="hidden"></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-title" class="block mb-1 text-[15px]">Title *</label>
                        <input type="text" placeholder="Course Title" id="form-course-title" value="<?php echo $course_details -> getTitle(); ?>" name="course-title" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100 placeholder:text-gray-500">
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-description" class="block mb-1 text-[15px]">Content *</label>
                        <textarea type="text" placeholder="Course Body" id="form-course-description" name="course-description" class="w-full px-4 py-2 rounded border outline-none h-36 resize-y border-blue-200 bg-gray-100 placeholder:text-gray-500"><?php echo $course_details -> getDescription(); ?></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="my-5 text-center">
                        <h2 class="z-10 relative bg-white inline-block px-3 text-gray-500">Course Classifying</h2>
                        <div class="w-80 h-px bg-gray-300 mx-auto relative bottom-3"></div>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-category" class="block mb-1 text-[15px]">Category *</label>
                        <select name="course-category" id="form-course-category" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100">
                            <option value="">Select a category</option>
                            <?php foreach($categories as $category): ?>

                                <option <?php if ($course_details -> getCategory() -> getCategoryId() == $category -> getCategoryId()) {echo 'selected';} ?> value='<?php echo $category -> getCategoryId(); ?>'><?php echo $category -> getCategoryName(); ?></option>

                            <?php endforeach; ?>
                        </select>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="mb-4">
                        <label for="form-course-tags" class="block mb-1 text-[15px]">Tags</label>
                        <input type="text" placeholder="Course Tags" id="form-course-tags" name="course-tags" class="w-full px-4 py-2 rounded border outline-none border-blue-200 bg-gray-100 placeholder:text-gray-500">
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <div class="my-5 text-center">
                        <h2 class="z-10 relative bg-white inline-block px-3 text-gray-500">Course Ressources</h2>
                        <div class="w-80 h-px bg-gray-300 mx-auto relative bottom-3"></div>
                    </div>

                    <p class="mb-1 text-[15px]">Type *</p>
                    <div class="mb-4 flex gap-3 flex-between">
                        <div class="flex-1">
                            <input type="radio" value="video" name="course-type" id="video-course-type" class="custom-radio hidden" <?php if ($course_details -> getType() == 'Video') {echo 'checked';} ?>>
                            <label for="video-course-type">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 128C0 92.7 28.7 64 64 64l256 0c35.3 0 64 28.7 64 64l0 256c0 35.3-28.7 64-64 64L64 448c-35.3 0-64-28.7-64-64L0 128zM559.1 99.8c10.4 5.6 16.9 16.4 16.9 28.2l0 256c0 11.8-6.5 22.6-16.9 28.2s-23 5-32.9-1.6l-96-64L416 337.1l0-17.1 0-128 0-17.1 14.2-9.5 96-64c9.8-6.5 22.4-7.2 32.9-1.6z"/></svg>
                                <span>Video</span>
                            </label>
                        </div>
                        <div class="flex-1">
                            <input type="radio" value="document" name="course-type" id="document-course-type" class="custom-radio hidden" <?php if ($course_details -> getType() == 'Document') {echo 'checked';} ?>>
                            <label for="document-course-type">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-gray-600" viewBox="0 0 384 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z"/></svg>
                                <span>Document</span>
                            </label>
                        </div>
                    </div>
                    <small class="text-red-400 font-semibold"></small>

                    <div class="mb-4">
                        <p class="mb-1 text-[15px]">File *</p>
                        <label for="form-course-file" class="file-label mb-2 h-20 bg-blue-200 border border-blue-300 text-gray-800 rounded flex gap-6 text-lg justify-center items-center cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-gray-800 w-6 h-6" viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/></svg>    
                            Upload a File
                        </label>
                        <input type="file" id="form-course-file" name="course-file" class="hidden"></textarea>
                        <small class="text-red-400 font-semibold"></small>
                    </div>

                    <button type="submit" class="h-10 w-32 bg-[#00A5CF] text-white block rounded submit-btn mt-6">Update</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/view.js"></script>

</body>
</html>