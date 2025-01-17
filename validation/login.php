<?php

    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/User.php';
    require __DIR__ . '/../classes/Student.php';
    require __DIR__ . '/../classes/Teacher.php';
    require __DIR__ . '/../classes/Admin.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CSRF_token = isset($_POST['CSRF_token']) ? $_POST['CSRF_token'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Check if access token already exist

        if (Security::isAccessTokenValid()) {
            header('Location: /index.php');
            exit;
        }

        // If CSRF Token is Invalid

        if (!Security::isCSRFTokenValid($CSRF_token)) {
            $_SESSION['errors'] = ['Invalid CSRF Token'];
            header('Location: /pages/auth.php');
            exit;
        }


        $user = new Student(0, '', '', $email, $password);

        if (!$user -> login()) {
            $_SESSION['errors'] = $user -> getErrors();
            header('Location: /pages/login.php');
            exit;
        }

        header('Location: /index.php');
        
    } else {
        header('Location: /pages/login.php');
    }
