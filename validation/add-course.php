<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Teacher.php';
    require __DIR__ . '/../classes/Course.php';
    require __DIR__ . '/../classes/VideoCourse.php';
    require __DIR__ . '/../classes/DocumentCourse.php';
    require __DIR__ . '/../classes/Category.php';

    $authorized_roles = ['teacher'];

    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CSRF_token = isset($_POST['CSRF_token']) ? $_POST['CSRF_token'] : '';
        $course_title = isset($_POST['course-title']) ? $_POST['course-title'] : '';
        $course_description = isset($_POST['course-description']) ? $_POST['course-description'] : '';
        $course_category = isset($_POST['course-category']) ? $_POST['course-category'] : '';
        $course_tags = isset($_POST['course-tags']) ? $_POST['course-tags'] : '';
        $course_background = isset($_POST['course-background']) ? $_POST['course-background'] : '';
        $course_type = isset($_POST['course-type']) ? $_POST['course-type'] : '';

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

        if (!in_array($user_row['role'], $authorized_roles)) {
            $_SESSION['errors'] = ['You are not authorized to perform this action.'];
            header('Location: /pages/login.php');
            exit;
        }

        $teacher = new Teacher($user_row['user_id'], $user_row['first_name'], $user_row['last_name'], $user_row['email']);

        // Load Category

        $category = new Category();

        if (!$category -> loadCategory($course_category)) {
            $_SESSION['errors'] = ['Could not add course'];
            header('Location: /pages/login.php');
            exit;
        }

        // Insert New Course

        if ($course_type == "document") {
            // $course = new D
        } else if ($course_type == "video") {

            $course = new VideoCourse(0, $course_title, $course_description, $category, $teacher, 'video');

            // Upload Course file

            if (isset($_FILES['course-file'])) {
                if (!$course -> uploadVideo($_FILES['course-file'])) {
                    $_SESSION["errors"] = $course -> getErrors();
                    header('Location: /pages/login.php');
                    exit;
                }
            }

        } else {
            $_SESSION['errors'] = ['Invalid Course type'];
            header('Location: /pages/login.php');
            exit;
        }

        // Upload Course Background

        if (isset($_FILES['course-background'])) {
            if (!$course -> uploadImage($_FILES['course-background'])) {
                $_SESSION["errors"] = $course -> getErrors();
                header('Location: /pages/login.php');
                exit;
            }
        }

        // Insert Course

        if(!$course -> createCourse()) {
            $_SESSION['errors'] = $course -> getErrors();
            header('Location: /pages/courses.php');
            exit;
        }

        // Split tags

        // $tags_list = explode(',', rtrim($post_tags, ','));

        // $post -> setTitle($post_title);
        // $post -> setContent($post_content);
        // $post -> setAuthorId($author_id);
        // $post -> setImage($_FILES['post-background']);


        // if (!$post -> createPost()) {
        //     $_SESSION['errors'] = $post -> getErrors();
        //     header('Location: /pages/blogs.php');
        //     exit;
        // }

        // // Insert tags

        // foreach($tags_list as $tag_item) {
        //     $tag = new Tag($db, $tag_item);
        //     $post -> addTag($tag);
        // }

        header('Location: /pages/view.php?id=' . $course -> getCourseId());
        
    } else {
        header('Location: /pages/login.php');
    }

?>