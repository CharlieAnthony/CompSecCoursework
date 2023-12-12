<?php
    session_start();

    echo "
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
                text-align: left;
                vertical-align: top;
                width: 300px;
                max-width: 300px;
                word-wrap: break-word;
            }
            
        </style>";

    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        // Redirect to login page
        header('Location: loginForm.php');
        exit;
    }
    if(!$_SESSION['isAdmin']){
        echo "You are not an admin!";
        header('Location: landingPage.php');
        exit;
    }

    $mysql_host = "localhost";
    $mysql_database = "AntiEval";
    $mysql_user = "root";
    $mysql_password = "";

    $connection = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to the server");

    $query = "SELECT * FROM EvaluationRequests WHERE Status = 'Pending'";
    $result = $connection->query($query);

    echo "<table>";
    echo "<tr><th>Description</th><th>Request Date</th><th>Contact</th><th>Image</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        $requestID = $row['RequestID'];
        $description = $row['Description'];
        $requestDate = $row['RequestDate'];
        $contactMethod = $row['ContactMethod'];
        $userID = $row['UserID'];

        if ($contactMethod == 'Phone') {
            $contactQuery = "SELECT PhoneNumber FROM Users WHERE UserID = '$userID'";
            $contactResult = $connection->query($contactQuery);
            $user = mysqli_fetch_assoc($contactResult);
            $contact = $user['PhoneNumber'];
        } else {
            $contactQuery = "SELECT Email FROM Users WHERE UserID = '$userID'";
            $contactResult = $connection->query($contactQuery);
            $user = mysqli_fetch_assoc($contactResult);
            $contact = $user['Email'];
        }

        $imageQuery = "SELECT PhotoPath FROM Photos WHERE RequestID = '$requestID'";
        $imageResult = $connection->query($imageQuery);
        $imageRow = mysqli_fetch_assoc($imageResult);

        if ($imageRow) {
            $imagePath = $imageRow['PhotoPath'];
        } else {
            $imagePath = 'no-image.png';
        }

        echo "<tr>";
        echo "<td>$description</td>";
        echo "<td>$requestDate</td>";
        echo "<td>$contact</td>";
        echo "<td><img src='$imagePath' alt='' style='max-width: 200px; max-height: 200px;'></td>";
        echo "</tr>";
    }

    echo "</div></table>";
    echo "<br/>Click <a href='landingPage.php'>here</a> to go back to the landing page.<br/>";
?>