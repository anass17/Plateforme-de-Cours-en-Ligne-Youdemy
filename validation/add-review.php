<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/Category.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Student.php';
    require __DIR__ . '/../classes/Review.php';

    $authorized_roles = ['student'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = isset($_POST['course-id']) ? $_POST['course-id'] : '';
        $rating = isset($_POST['rating-input']) ? $_POST['rating-input'] : '';
        $course_review = isset($_POST['course-review']) ? $_POST['course-review'] : '';

        $user_row = Security::isAccessTokenValid();

        if (!$user_row) {
            header('Location: /pages/login.php');
            exit;
        }

        $user = new Student($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role']);
        
        // Check if user is authorized to perform this action
        
        Security::authorizedAccess($user, $authorized_roles);

        $review = new Review(0, $course_review, (int) $rating);

        // Insert Course

        if(!$review -> addReview($user -> getUserId(), (int) $course_id)) {
            $_SESSION['errors'] = $review -> getErrors();
            header('Location: /pages/courses.php');
            exit;
        } else {
            $_SESSION['success'] = "Review Added Successfully";
        }

        header('Location: /pages/view.php?id=' . $course_id);
        
    } else {
        header('Location: /pages/login.php');
    }

?>