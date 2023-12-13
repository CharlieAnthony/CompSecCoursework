<?php

    session_start();

    echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        <div class='form-container'>
            
            <form action='registerCheck.php' method='POST'>
                <h1> Lovejoy's Antique Evaluation </h1>
                <div class='form-group'>
                    <label for='txtForename'>Forename:</label>
                    <input id='txtForename' name='txtForename' type='text' />
                </div>
                <div class='form-group'>
                    <label for='txtSurname'>Surname:</label>
                    <input id='txtSurname' name='txtSurname' type='text' />
                </div>
                <div class='form-group'>
                    <label for='txtPhoneNumber'>Phone Number:</label>
                    <input id='txtPhoneNumber' name='txtPhoneNumber' type='text' />
                </div>  
                <div class='form-group'>
                    <label for='txtEmail1'>Email:</label>
                    <input id='txtEmail1' name='txtEmail1' type='text' />
                </div>
                <div class='form-group'>
                    <label for='txtEmail2'>Confirm Email:</label>
                    <input id='txtEmail2' name='txtEmail2' type='text' />
                </div>
                <div class='form-group'>
                    <label for='txtPassword1'>Password:</label>
                    <input id='txtPassword1' name='txtPassword1' type='password' oninput='passwordStrength(this.value)'/>
                </div>
                <div class='form-group'>
                    <label for='txtPassword2'>Confirm Password:</label>
                    <input id='txtPassword2' name='txtPassword2' type='password'/>
                </div>
                <div id='passwordStrength'></div>";

        // Display errors if there are any
        echo "<div class='form-group'>";
        if (isset($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            unset($_SESSION['errors']); // remove the errors from session
        }
        echo "</div>";

        echo "
                <div class='form-group'>
                    <input type='submit' value='Create Account'>
                </div>
            </form>
            </div>
            <script>
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