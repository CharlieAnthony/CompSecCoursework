<?php
    session_start();

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    // Check if user is logged in
    if (!isset($_SESSION['userID'])) {
        echo "You are not logged in!";
        // Redirect to login page
        header('Location: loginForm.php');
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

    echo "
        <link rel='stylesheet' type='text/css' href='style.css'>
        <div class='form-container'>
            
            <form action='evalCheck.php' method='POST' enctype='multipart/form-data'>   
                <h1>Evaluation Request</h1>
                <div class='form-group'>
                    <label for='txtDescription'>Item Description:</label>
                    <textarea id='txtDescription' name='txtDescription' maxlength='250' rows='5' cols='50' style='resize: none;'></textarea>
                </div>
                <div class='form-group'>
                    <label for='file'>Upload Image:</label>
                    <input id='file' name='file' type='file' onchange='checkFileSize(this)' accept='.png, .jpg, .jpeg' />
                    <p>
                        Image must be:<ul>
                            <li>png, jpg or jpeg</li>
                            <li>less than 2MB</li>
                        </ul>
                    </p>
                </div>
                <div class='form-group'>
                    <label for='txtContactMethod'>Preferred Contact Method:</label>
                    <select id='txtContactMethod' name='txtContactMethod'>
                        <option value='Phone'>Phone</option>
                        <option value='Email'>Email</option>
                    </select>
                </div>";

    // Display errors if there are any
    echo "<div class='form-group'>";
    if (isset($_SESSION['errors'])) {
        foreach ($_SESSION['errors'] as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        unset($_SESSION['errors']); // remove the errors from session
    }
    echo "</div>";
    echo "
                <div class='form-group'>
                    <input type='submit' value='Submit Request'>
                </div>
            </form>
        </div>
        ";
?>

<script>
    function checkFileSize(input) {
        // Get the selected file
        var file = input.files[0];

        // Check the file size (2MB in this case)
        if (file.size > 2 * 1024 * 1024) {
            alert("File size is too large. Maximum allowed size is 2MB.");
            // Clear the input
            input.value = "";
        } else {
            // Set the value of the hidden input field to the path of the uploaded file
            document.getElementById('imagePath').value = URL.createObjectURL(file);
        }
    }
</script>