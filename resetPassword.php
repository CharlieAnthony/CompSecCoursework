<?php

    session_start();

    $token = $_GET['token'];

    // html form
    echo "<link rel='stylesheet' type='text/css' href='style.css'>
    <div class='form-container'>
    <form action='resetPasswordCheck.php' method='POST'>
    <h1>Reset Password</h1>
    <p>Enter your new Password</p>
    <input name='txtPassword1' type='password' oninput='passwordStrength(this.value)'/>
    <p>Confirm your new Password</p>
    <input name='txtPassword2' type='password' />
    <div id='passwordStrength'></div>
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
    </form></div><script>
            function passwordStrength(password){
                let s = 0;
                if (password.length >= 8) {
                    s++;
                }
                if (password.match(/[a-z]/)) {
                    s++;
                }
                if (password.match(/[A-Z]/)) {
                    s++;
                }
                if (password.match(/[0-9]/)) {
                    s++;
                }
                if (password.match(/[\'^£$%&*()}{@#~?><>.,|=_+!-]/)) {
                    s++;
                }
                if (s == 0) {
                    document.getElementById('passwordStrength').innerHTML = '';
                }
                if (s == 1) {
                    document.getElementById('passwordStrength').innerHTML = '<p style=\'color:red;\'>Weak Password</p>';
                }
                if (1 < s && s <= 4) {
                    document.getElementById('passwordStrength').innerHTML = '<p style=\'color:orange;\'>Average Password</p>';
                }
                if (s == 5) {
                    document.getElementById('passwordStrength').innerHTML = '<p style=\'color:green;\'>Strong Password</p>';
                }
            }
            </script>";

?>
