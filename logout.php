<?php

    // unset session variables
    session_start();
    session_unset();

    echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        <p>You have successfully logged out.<br/>
        Click <a href='loginForm.php'>here</a> to log back in.</p>
    ";

?>
