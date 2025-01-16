
<?php
    session_start();

    require __DIR__ . '/../classes/Database.php';
    require __DIR__ . '/../classes/Security.php';
    require __DIR__ . '/../classes/User.php';

    User::logout();

    header('Location: /pages/login.php');
    
?>