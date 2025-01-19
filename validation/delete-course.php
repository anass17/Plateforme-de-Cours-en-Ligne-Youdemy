<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/Category.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Admin.php';
    require __DIR__ . '/../classes/Teacher.php';
    require __DIR__ . '/../classes/Course.php';
    require __DIR__ . '/../classes/VideoCourse.php';
    require __DIR__ . '/../classes/DocumentCourse.php';

    $authorized_roles = ['teacher', 'admin'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $course_id = isset($_POST['course-id']) ? $_POST['course-id'] : '';

        $user_row = Security::isAccessTokenValid();

        if (!$user_row) {
            header('Location: /pages/login.php');
            exit;
        }


        // Check if user is authorized to perform this action

        if (!in_array($user_row['role'], $authorized_roles)) {
            $_SESSION['errors'] = ['You are not authorized to access that page.'];
            header('Location: /pages/login.php');
            exit;
        }

        $course = Course::getCourse($course_id);

        if ($user_row['role'] == "admin") {
            $user = new Admin($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email']);
        } else {
            $user = new Teacher($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email']);

            if ($course -> getTeacher() -> getUserId() != $user -> getUserId()) {
                $_SESSION['errors'] = ['You are not authorized to access that page.'];
                header('Location: /pages/login.php');
                exit;
            }
        }

        // Delete course

        if(!$course -> deleteCourse()) {
            $_SESSION['errors'] = $course -> getErrors();
            header('Location: /pages/courses.php');
            exit;
        }

        header('Location: /pages/view.php?id=' . $course -> getCourseId());
        
    } else {
        header('Location: /pages/login.php');
    }

?>