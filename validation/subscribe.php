<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/Category.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Student.php';
    require __DIR__ . '/../classes/Course.php';
    require __DIR__ . '/../classes/VideoCourse.php';
    require __DIR__ . '/../classes/DocumentCourse.php';

    $authorized_roles = ['student'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = isset($_POST['course-id']) ? $_POST['course-id'] : '';

        $user_row = Security::isAccessTokenValid();

        if (!$user_row) {
            header('Location: /pages/login.php');
            exit;
        }

        // Check if user is authorized to perform this action

        if (!in_array($user_row['role'], $authorized_roles)) {
            $_SESSION['errors'] = ['You are not authorized to perform this action.'];
            header('Location: /pages/login.php');
            exit;
        }

        $student = new Student($user_row['user_id']);

        if (!$student -> subscribeToCourse($course_id)) {
            $_SESSION['errors'] = $student -> getErrors();
        } else {
            $_SESSION['success'] = "You have successfully subscribed to this course";
        }

        header('Location: /pages/view.php?id=' . $course_id);
        
    } else {
        header('Location: /pages/login.php');
    }