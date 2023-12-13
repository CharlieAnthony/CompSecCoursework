<?php

    // Start the session
    session_start();

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        // Redirect to login page
        header('Location: loginForm.php');
        exit;
    }

    $userID = $_SESSION['userID'];

    // check if user has timed out
    $result = $conn->query("SELECT LastLoginDate FROM Users WHERE UserID = '$userID'");
    $row = $result->fetch_assoc();
    $lastLogin = strtotime($row['LastLoginDate']);
    $now = time();
    $timeoutLength = 30 * 60;
    if ($now - $lastLogin > $timeoutLength) {
        session_destroy();
        header('Location: loginForm.php');
        exit;
    }
    echo "<link rel='stylesheet' type='text/css' href='style.css'>";


    // Check if user is an admin
    $name = "";
    if ($_SESSION['isAdmin']) {
        echo "<p>Welcome, " . $_SESSION['forename'] . "! You have admin privileges.<br/>";
    } else {
        echo "<p>Welcome, " . $_SESSION['forename'] . "!<br/>";
    }

    echo "<a href='evalRequest.php' class='button'>Evaluation Request</a><br/>";
    if ($_SESSION['isAdmin']) {
        echo "<a href='viewListings.php' class='button'>View Listings</a><br/>";
    }
    echo "<a href='logout.php' class='button'>Logout</a></p>";




?>