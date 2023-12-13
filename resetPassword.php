<?php

    $token = $_GET['token'];

    echo "<link rel='stylesheet' type='text/css' href='style.css'>
    <div class='form-container'>
    <form action='resetPasswordCheck.php' method='POST'>
    <h1>Reset Password</h1>
    <p>Enter your new Password</p>
    <input name='txtPassword1' type='password' />
    <p>Confirm your new Password</p>
    <input name='txtPassword2' type='password' />
    <input name='token' type='hidden' value='$token' />";
    // Display errors if there are any
    echo "<div class='form-group'>";
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        unset($_SESSION['errors']); // remove the errors from session
    }
    echo "</div>
    <br/><br/><input type='submit' value='Submit'>
    </form></div>";

?>
