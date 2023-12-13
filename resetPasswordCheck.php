<?php

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    $password1 = $_POST['txtPassword1'];
    $password2 = $_POST['txtPassword2'];
    $token = $_POST['token'];

    // array for returning errors
    $errors = [];

    if ($password1 == "" or $password2 == "") {
        $errors[] = "Password is blank!<br/>";
    }

    // password check stuff

    if(empty($errors)) {
        // check if password is at least 8 characters long
        if (strlen($password1) < 8) {
            $errors[] = "Password must be at least 8 characters long!<br/>";
        }
        // check if password contains at least one number
        if (!preg_match("#[0-9]+#", $password1)) {
            $errors[] = "Password must contain at least one number!<br/>";
        }
        // check if password contains at least one capital letter
        if (!preg_match("#[A-Z]+#", $password1)) {
            $errors[] = "Password must contain at least one capital letter!<br/>";
        }
        // check if password contains at least one lowercase letter
        if (!preg_match("#[a-z]+#", $password1)) {
            $errors[] = "Password must contain at least one lowercase letter!<br/>";
        }
        // check if password contains at least one special character
        if (!preg_match("/[\'^£$%&*()}{@#~?><>.,|=_+!-]/", $password1)) {
            $errors[] = "Password must contain at least one special character!<br/>";
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: resetPassword.php?token='.$token);
        exit;
    }

    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);
    $conn->query("UPDATE Users SET PasswordHash = '$hashed_password' WHERE Email = (SELECT Email FROM ResetRequests WHERE Token = '$token')");
    $conn->query("DELETE FROM ResetRequests WHERE Token = '$token'");

    // Redirect to login form
    header('Location: loginForm.php');
    exit;