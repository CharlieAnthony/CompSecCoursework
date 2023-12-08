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
        </style>";

    $mysql_host = "localhost";
    $mysql_database = "SocNet";
    $mysql_user = "root";
    $mysql_password = "";

    // connect to the server
    $connection = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to the server");

    // copy all of the data from form to variables
    $forename = $_POST['txtForename'];
    $surname = $_POST['txtSurname'];
    $phone = $_POST['txtPhoneNumber'];
    $email1 = $_POST['txtEmail1'];
    $email2 = $_POST['txtEmail2'];
    $password1 = $_POST['txtPassword1'];
    $password2 = $_POST['txtPassword2'];

    // flag for error
    $errorOccurred = 0;

    echo "<p>";
    // make sure none blank
    if ($forename == "")
    {
        echo "Forename black!<br/>";
        $errorOccurred = 1;
    }
    if ($surname == "")
    {
        echo "Surname black!<br/>";
        $errorOccurred = 1;
    }
    if ($phone == "")
    {
        echo "Phone Number black!<br/>";
        $errorOccurred = 1;
    }
    if ($email1 == "" or $email2 == "")
    {
        echo "Email black!<br/>";
        $errorOccurred = 1;
    }
    if ($password1 == "" or $password2 == "")
    {
        echo "Password black!<br/>";
        $errorOccurred = 1;
    }


    if ($errorOccurred == 1)
    {
        echo "<a href='registerForm.php'>Go back to register form</a><br/>";
    }
    echo "</p>";
?>