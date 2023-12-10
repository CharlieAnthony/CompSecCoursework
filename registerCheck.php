<?php
session_start();

$mysql_host = "localhost";
$mysql_database = "AntiEval";
$mysql_user = "root";
$mysql_password = "";

$connection = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to the server");

$forename = $_POST['txtForename'];
$surname = $_POST['txtSurname'];
$phone = $_POST['txtPhoneNumber'];
$email1 = $_POST['txtEmail1'];
$email2 = $_POST['txtEmail2'];
$password1 = $_POST['txtPassword1'];
$password2 = $_POST['txtPassword2'];

// array for returning errors
$errors = [];

// make sure none blank
if ($forename == "") {
    $errors[] = "Forename is blank!<br/>";
}
if ($surname == "") {
    $errors[] = "Surname is blank!<br/>";
}
if ($phone == "") {
    $errors[] = "Phone Number is blank!<br/>";
}
if ($email1 == "" or $email2 == "") {
    $errors[] = "Email is blank!<br/>";
}
if ($password1 == "" or $password2 == "") {
    $errors[] = "Password is blank!<br/>";
}

// if there are no errors
if (empty($errors)) {
    // check if emails match
    if ($email1 != $email2) {
        $errors[] = "Emails do not match!<br/>";
    }
    // check if passwords match
    if ($password1 != $password2) {
        $errors[] = "Passwords do not match!<br/>";
    }
    // check if email is valid
    if (!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid!<br/>";
    }
    // check if phone number is only numbers or plus sign
    if (!preg_match("/^[0-9+]+$/", $phone)) {
        $errors[] = "Phone number is not valid!<br/>";
    }

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

    if (empty($errors)) {
        // check if email already in database
        $userResult = $connection->query("SELECT * FROM Users");

        // loop through records
        while ($userRow = mysqli_fetch_array($userResult)) {
            if ($userRow['Email'] == $email1) {
                echo "Email already in use!";
                $errorOccurred = 1;
            }
        }
    }
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: registerForm.php');
    exit;
}

$hashed_password = password_hash($password1, PASSWORD_DEFAULT);
$sql = "INSERT INTO Users (Forename, Surname, PhoneNumber, Email, PasswordHash, RegistrationDate, LastLoginDate) 
VALUES ('$forename', '$surname', '$phone', '$email1', '$hashed_password', NOW(), NOW())";
if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
    header('Location: loginForm.php');
}

?>