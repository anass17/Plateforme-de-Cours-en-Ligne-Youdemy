<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Student.php';
    require __DIR__ . '/../classes/Teacher.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CSRF_token = isset($_POST['CSRF_token']) ? $_POST['CSRF_token'] : '';
        $first_name = isset($_POST['first-name']) ? $_POST['first-name'] : '';
        $last_name = isset($_POST['last-name']) ? $_POST['last-name'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $account_type = isset($_POST['account-type']) ? $_POST['account-type'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $bio = isset($_POST['bio']) ? $_POST['bio'] : '';
        
        // Check if access token already exist

        if (Security::isAccessTokenValid()) {
            header('Location: /index.php');
            exit;
        }

        // Check CSRF Token validity

        if (!Security::isCSRFTokenValid($CSRF_token)) {
            $_SESSION['errors'] = ['Invalid CSRF Token'];
            header('Location: /pages/register.php');
            exit;
        }

        // 

        if ($account_type == "student") {
            $student = new Student(0, $first_name, $last_name, $email, $password, 'student', '', '', 'active');

            if (!$student -> register()) {
                $_SESSION['errors'] = $student -> getErrors();
                header('Location: /pages/register.php');
                exit;
            }

        } else if ($account_type == 'teacher') {
            $teacher = new Teacher(0, $first_name, $last_name, $email, $password, 'student', '', '', 'active', $title, $bio);

            if (!$teacher -> register()) {
                $_SESSION['errors'] = $teacher -> getErrors();
                header('Location: /pages/register.php');
                exit;
            }
        } else {
            $_SESSION['errors'] = ["The selected account type must be either student or teacher"];
            header('Location: /pages/register.php');
            exit;
        }

        Security::updateCSRFToken();

        header('Location: /index.php');
        
    } else {
        header('Location: /pages/register.php');
    }
