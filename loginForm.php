<?php

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
                <div class='form-group'>
                    <input type='submit' value='Login'>
                </div>
                <div class='form-group'>
                    Not registered yet? Click <a href='registerForm.php'>Here</a>
                </div>
            </form>
            </div>";

?>