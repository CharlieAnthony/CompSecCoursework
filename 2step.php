<?php

    // Start the session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        header('Location: loginForm.php');
        exit;
    }

    // Display 2step form
    echo "<link rel='stylesheet' type='text/css' href='style.css'>
          <div class='form-container'>
          <h1>2-Step Authentication</h1>
          <p>Enter the code sent to your Email</p>
          <form action='2stepCheck.php' method='POST'>
          <input name='txtCode' type='text' /><br/>
          <br/> <input type='submit' value='Submit'>
          </form>
          </div>";

?>