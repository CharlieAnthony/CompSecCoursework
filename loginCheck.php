<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    session_start();

    // Flag for 2step authy
    $twoStepEnabled = 1;

    function generateCode(){
        return rand(100000, 999999);
    }

    function sendCode($email, $code){

        require 'vendor/autoload.php';

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
            $mail->Subject = '2-Step Authentication';
            $mail->Body    = 'Your code is: ' . $code;
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit;
        }
    }

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

    if ($userResult -> num_rows > 0)
    {
        while($userRow = $userResult -> fetch_assoc())
        {
            if($userRow['Email'] == $email)
            {
                $userFound = 1;
                if (password_verify($password, $userRow['PasswordHash']))
                {
                    if($twoStepEnabled == 0) {
                        // Store user data in session
                        $_SESSION['isAdmin'] = $userRow['IsAdmin']; // Assuming 'IsAdmin' is the column name for admin status
                        $_SESSION['forename'] = $userRow['Forename'];
                        $_SESSION['userID'] = $userRow['UserID'];
                        // Redirect to landing page
                        header('Location: landingPage.php');
                        exit;
                    }else{
                        $code = generateCode();
                        sendCode($email, $code);
                        $_SESSION['isAdmin'] = $userRow['IsAdmin']; // Assuming 'IsAdmin' is the column name for admin status
                        $_SESSION['forename'] = $userRow['Forename'];
                        $_SESSION['userID'] = $userRow['UserID'];
                        $_SESSION['code'] = $code;
                        $_SESSION['email'] = $email;
                        header('Location: 2step.php');
                        exit;
                    }
                }
                else
                {
                    echo "Wrong Password";
                }
            }
        }
    }

    if ($userFound == 0)
    {
        echo "This user was not found in our database";
    }

?>