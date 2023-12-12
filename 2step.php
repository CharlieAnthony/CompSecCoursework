<?php

    // Start the session
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        header('Location: loginForm.php');
        exit;
    }

    echo "<link rel='stylesheet' type='text/css' href='style.css'>
          <h1>2-Step Authentication</h1>
          <p>Enter the code sent to your Email</p>
          <form action='2stepCheck.php' method='POST'>
          <input name='txtCode' type='text' />
          <br/> <input type='submit' value='Submit'>
          </form>";

?>