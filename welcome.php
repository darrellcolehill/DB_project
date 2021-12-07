<?php
    session_start();
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        header("location: login.php");
    }
    
?>