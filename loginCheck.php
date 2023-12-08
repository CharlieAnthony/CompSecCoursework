<?php

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    // values come from user, through web form
    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];

    // Check connection
    if($conn->connect_error)
    {
        die ("Connection failed" .$conn->connect_error);
    }

    // query
    $userQuery = "SELECT * FROM SystemUser";
    $userResult = $conn->query($userQuery);

    // flag variable
    $userFound = 0;

    echo "<table border='1'>";
    if ($userResult -> num_rows > 0)
    {
        while($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Username'] == $username)
            {
                $userFound = 1;
                if (password_verify($password, $userRow['Password']))
                {
                    echo "Hi" .$username . "!";
                    echo "<br/>Welcome to my website";
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