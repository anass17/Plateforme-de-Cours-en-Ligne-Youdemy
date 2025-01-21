<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/Category.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Teacher.php';
    require __DIR__ . '/../classes/Course.php';
    require __DIR__ . '/../classes/VideoCourse.php';
    require __DIR__ . '/../classes/DocumentCourse.php';

    $authorized_roles = ['teacher'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CSRF_token = isset($_POST['CSRF_token']) ? $_POST['CSRF_token'] : '';
        $course_id = isset($_POST['course-id']) ? $_POST['course-id'] : '';
        $course_title = isset($_POST['course-title']) ? $_POST['course-title'] : '';
        $course_description = isset($_POST['course-description']) ? $_POST['course-description'] : '';
        $course_category = isset($_POST['course-category']) ? $_POST['course-category'] : '';
        $course_tags = isset($_POST['course-tags']) ? $_POST['course-tags'] : '';
        $course_background = isset($_POST['course-background']) ? $_POST['course-background'] : '';

        $user_row = Security::isAccessTokenValid();

        if (!$user_row) {
            header('Location: /pages/login.php');
            exit;
        }

        // If CSRF Token is Invalid

        if (!Security::isCSRFTokenValid($CSRF_token)) {
            $_SESSION['errors'] = ['Invalid CSRF Token'];
            header('Location: /pages/login.php');
            exit;
        }

        // Check if user is authorized to perform this action

        $teacher = new Teacher($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email'], '', $user_row['role']);

        Security::authorizedAccess($teacher, $authorized_roles);


        // Load Category

        $category = new Category();

        if (!$category -> loadCategory($course_category)) {
            $_SESSION['errors'] = ['Could not add course'];
            header('Location: /pages/login.php');
            exit;
        }

        $course = Course::getCourse($course_id);

        // Upload Course Background

        if (isset($_FILES['course-background'])) {
            if (!$course -> uploadImage($_FILES['course-background'])) {
                $_SESSION["errors"] = $course -> getErrors();
                header('Location: /pages/login.php');
                exit;
            }
        }

        $course -> setTitle($course_title);
        $course -> setDescription($course_description);
        $course -> setCategory($category);

        // Update Course

        if(!$course -> updateCourse()) {
            $_SESSION['errors'] = $course -> getErrors();
            header('Location: /pages/courses.php');
            exit;
        }

        header('Location: /pages/view.php?id=' . $course -> getCourseId());
        
    } else {
        header('Location: /pages/login.php');
    }

?>