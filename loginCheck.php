<?php

    session_start();

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    // values come from user, through web form
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    // Check connection
    if($conn->connect_error)
    {
        die ("Connection failed" .$conn->connect_error);
    }

    // query
    $userQuery = "SELECT * FROM Users";
    $userResult = $conn->query($userQuery);

    // flag variable
    $userFound = 0;

    echo "<table border='1'>";
    if ($userResult -> num_rows > 0)
    {
        while($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Email'] == $email)
            {
                $userFound = 1;
                if (password_verify($password, $userRow['PasswordHash']))
                {
                    // Store user data in session
                    $_SESSION['email'] = $email;
                    $_SESSION['isAdmin'] = $userRow['IsAdmin']; // Assuming 'IsAdmin' is the column name for admin status

                    // Redirect to landing page
                    header('Location: landingPage.php');
                    exit;
                }
                else
                {
                    echo "Wrong Password";
                }
            }
        }
    }
    echo "</table>";

    if ($userFound == 0)
    {
        echo "This user was not found in our database";
    }

?>