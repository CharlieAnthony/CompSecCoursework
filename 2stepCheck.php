<?php

    session_start();

    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    // Check if user is logged in
    if (!isset($_SESSION['userID']) or !isset($_SESSION['code'])) {
        echo "You are not logged in!";
        header('Location: loginForm.php');
        exit;
    }

    if (isset($_POST['txtCode'])) {
        $code = $_POST['txtCode'];
        // Check if code is correct
        if ($code == $_SESSION['code']) {
            $conn->query("UPDATE Users SET LastLoginDate = NOW() WHERE UserID = ".$_SESSION['userID']);
            unset($_SESSION['code']);
            header('Location: landingPage.php');
            exit;
        } else {
            // Code is incorrect
            echo "<p style='color:red;'>Incorrect code</p>";
        }
    }

?>