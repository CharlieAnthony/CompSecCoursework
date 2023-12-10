<?php

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    echo "You are not logged in!";
    // Redirect to login page
//    header('Location: loginForm.php');
//    exit;
}

// Check if user is an admin
if ($_SESSION['isAdmin']) {
    echo "Welcome, " . $_SESSION['email'] . "! You have admin privileges.";
} else {
    echo "Welcome, " . $_SESSION['email'] . "!";
}



?>