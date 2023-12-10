<?php

    session_start();

    echo "
            <style>
                body {
                    font-family: Arial, sans-serif;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    padding: 0;
                }
                .form-container {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    max-width: 500px;
                    margin: 0 auto;
                }
                .form-group {
                    margin-bottom: 1em;
                }
                .form-group label {
                    display: block;
                    margin-bottom: 0.5em;
                }
                .form-group input {
                    width: 100%;
                    padding: 0.5em;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }
                .form-group input[type='submit'] {
                    width: auto;
                    background-color: #4CAF50;
                    color: white;
                    cursor: pointer;
                }
                .form-group input[type='submit']:hover {
                    background-color: #45a049;
                }
            </style>
        ";

        echo "
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
                    <input id='txtPassword1' name='txtPassword1' type='password' />
                </div>
                <div class='form-group'>
                    <label for='txtPassword2'>Confirm Password:</label>
                    <input id='txtPassword2' name='txtPassword2' type='password' />
                </div>";

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
            </div>";

?>