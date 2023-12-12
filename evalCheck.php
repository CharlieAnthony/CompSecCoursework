<?php

    session_start();

    $mysql_host = "localhost";
    $mysql_database = "AntiEval";
    $mysql_user = "root";
    $mysql_password = "";

    $connection = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database) or die ("could not connect to the server");

    $userID = $_SESSION['userID'];
    $description = $_POST['txtDescription'];
    $image_path = "";
    $contact_method = $_POST['txtContactMethod'];

    echo $contact_method;

    // array for returning errors
    $errors = [];

    // make sure description not blank
    if ($description == "") {
        $errors[] = "Description is blank!<br/>";
    }

    // flag for image related errors
    $image_errors = 0;

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];

        // Check for errors
        if ($file['error'] == 0) {

            // Makes sure file extension is png or jpeg
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ($ext != 'PNG' && $ext != 'JPEG' && $ext != 'JPG') {
                $errors[] = "Invalid file type. Only png, jpg and jpeg images are allowed.<br/>";

            }else {
                // Check media type
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, $file['tmp_name']);
                if ($mime != 'image/png' && $mime != 'image/jpeg' && $mime != 'image/jpg') {
                    $errors[] = "Invalid file type. Only png, jpg and jpeg images are allowed.<br/>";
                }else {
                    // File limit cap of 2MB
                    if ($file['size'] > 2 * 1024 * 1024) {
                        $errors[] = "File size is too large. Maximum allowed size is 2MB.<br/>";
                    }else {
                        // Rename the file
                        $newName = uniqid() . '.' . $ext;

                        // Move the file to the desired directory
                        if (move_uploaded_file($file['tmp_name'], 'uploads/' . $newName)) {
                            $image_path = 'uploads/' . $newName;
                            echo "File uploaded successfully.";
                        } else {
                            $errors[] = "Failed to upload file.";
                            $image_path = "";
                        }
                    }
                }
            }
        }
    }

    // if there are no errors
    if (empty($errors)){
        // insert request into database
        $insertQuery = "INSERT INTO EvaluationRequests (UserID, Description, RequestDate, Status, ContactMethod)
                        VALUES ('$userID', '$description', NOW(), 'Pending', '$contact_method')";
        $insertResult = $connection -> query($insertQuery);

        // check if image included
        if ($image_path != "") {
            // get request ID
            $requestID = $connection->insert_id;

            // insert image into database
            $insertQuery = "INSERT INTO Photos (RequestID, PhotoPath, UploadDate)
                            VALUES ('$requestID', '$image_path', NOW())";
            $insertResult = $connection->query($insertQuery);
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: evalRequest.php');
        exit;
    }else{
        header('Location: landingPage.php');
        exit;
    }

?>