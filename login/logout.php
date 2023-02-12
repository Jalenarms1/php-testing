<?php
    session_start();
    unset($_SESSION['user_id']);
    session_destroy();
    setcookie("logged_in", "", time() - 3600);
    header('Location: /index.php');