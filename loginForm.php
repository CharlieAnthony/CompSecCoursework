<?php

    echo "
        <style>
            body {
                font-family: Arial, sans-serif;
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
        <form action='loginCheck.php' method='POST'>
            <div class='form-group'>
                <label for='txtUsername'>Username:</label>
                <input id='txtUsername' name='txtUsername' type='text' />
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
        </form>";

?>