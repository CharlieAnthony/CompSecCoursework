<?php

    // Start the session
    session_start();

    echo "<link rel='stylesheet' type='text/css' href='style.css'>";

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        // Redirect to login page
        header('Location: loginForm.php');
        exit;
    }

    // Check if user is an admin
    $name = "";
    if ($_SESSION['isAdmin']) {
        echo "<p>Welcome, " . $_SESSION['forename'] . "! You have admin privileges.<br/>";
    } else {
        echo "<p>Welcome, " . $_SESSION['forename'] . "!<br/>";
    }

    echo "<a href='evalRequest.php' class='button'>Evaluation Request</a><br/>";
    if ($_SESSION['isAdmin']) {
        echo "<a href='admin.php' class='button'>View Listings</a><br/>";
    }
    echo "<a href='logout.php' class='button'>Logout</a></p>";




?>