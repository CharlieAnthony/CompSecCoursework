<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    // Server and db connection
    $servername = "localhost";
    $rootuser = "root";
    $db = "AntiEval";
    $rootPassword = "";

    // Create connection
    $conn = new mysqli($servername, $rootuser, $rootPassword, $db);

    $email = $_POST['txtEmail'];

    // Check connection
    if($conn->connect_error)
    {
        die ("Connection failed" .$conn->connect_error);
    }

    // user query
    $userQuery = "SELECT * FROM Users";
    $userResult = $conn->query($userQuery);

    // flag variable
    $userFound = 0;

    if ($userResult -> num_rows > 0)
    {
        while($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Email'] == $email)
            {
                // generate token and put in table
                $userFound = 1;
                $token = rand(100000, 999999);
                $conn->query("INSERT INTO ResetRequests (Email, Token, RequestDate) VALUES ('$email', '$token', NOW())");

                $_SESSION['email'] = $email;

                // send email
                $mail = new PHPMailer(true);
                try{
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = '2stepauthy@gmail.com';
//            $mail->Password   = '3Ussex_uni';
                    $mail->Password   = 'sfoo mwii shxo bmgt';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port       = 587;
                    $mail->setFrom('2stepauthy@gmail.com', '2stepauthy');
                    $mail->addAddress($email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Password';
                    $mail->Body    = "Click <a href='http://localhost/CompSecCoursework/resetPassword.php?token=$token'>here</a> to reset your password.";
                    $mail->send();

                } catch (Exception $e) {
//                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    exit;
                }
            }
        }
    }
    echo "Please check your email for a link to reset your password.";

?>