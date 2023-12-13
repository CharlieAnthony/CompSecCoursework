<?php

    session_start();

    echo "
            <link rel='stylesheet' type='text/css' href='style.css'>
            <div class='form-container'>
                <form action='loginCheck.php' method='POST'>
                    <h1> Lovejoy's Antique Evaluation </h1>
                    <div class='form-group'>
                        <label for='txtEmail'>Email:</label>
                        <input id='txtEmail' name='txtEmail' type='text' />
                    </div>
                    <div class='form-group'>
                        <label for='txtPassword'>Password:</label>
                        <input id='txtPassword' name='txtPassword' type='password' />
                    </div>
                    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
                    <div class='g-recaptcha' data-sitekey='6LdgfDApAAAAAPrJ6LkdLGNlVcvl7nIrwsBFDHQh'></div>";
    // Display errors if there are any
    echo "<div class='form-group'>";
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        unset($_SESSION['errors']); // remove the errors from session
    }
    echo "          </div>
                    
                    <div class='form-group'>
                        <input type='submit' value='Login'>
                    </div>
                    <div class='form-group'>
                        Not registered yet? Click <a href='registerForm.php'>Here</a>
                    </div>
                </form>
            </div>
        ";

?>