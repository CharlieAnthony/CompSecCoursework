<?php
    session_start();

    $mysql_host = "localhost";
    $mysql_database = "AntiEval";
    $mysql_user = "root";
    $mysql_password = "";

    $conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to the server");

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

    $userID = $_SESSION['userID'];

    // check if user has timed out
    $result = $conn->query("SELECT LastLoginDate FROM Users WHERE UserID = '$userID'");
    $row = $result->fetch_assoc();
    $lastLogin = strtotime($row['LastLoginDate']);
    $now = time();
    $timeoutLength = 30 * 60;
    if ($now - $lastLogin > $timeoutLength) {
        session_destroy();
        header('Location: loginForm.php');
        exit;
    }

    $query = "SELECT * FROM EvaluationRequests WHERE Status = 'Pending'";
    $result = $conn->query($query);

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
            $contactResult = $conn->query($contactQuery);
            $user = mysqli_fetch_assoc($contactResult);
            $contact = $user['PhoneNumber'];
        } else {
            $contactQuery = "SELECT Email FROM Users WHERE UserID = '$userID'";
            $contactResult = $conn->query($contactQuery);
            $user = mysqli_fetch_assoc($contactResult);
            $contact = $user['Email'];
        }

        $imageQuery = "SELECT PhotoPath FROM Photos WHERE RequestID = '$requestID'";
        $imageResult = $conn->query($imageQuery);
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