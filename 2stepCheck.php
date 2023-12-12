<?php

    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['userID']) or !isset($_SESSION['code'])) {
        echo "You are not logged in!";
        header('Location: loginForm.php');
        exit;
    }

    if (isset($_POST['txtCode'])) {
        $code = $_POST['txtCode'];
        if ($code == $_SESSION['code']) {
            // Code is correct
            unset($_SESSION['code']);
            header('Location: landingPage.php');
            exit;
        } else {
            // Code is incorrect
            echo "<p style='color:red;'>Incorrect code</p>";
        }
    }

?>