<?php
require_once('functions/token.php');

session_start();


$errorCount = 0;
$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$_SESSION['email'] = $email;

if ($errorCount > 0) {
    $session_error = "You have " . $errorCount . " Error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form";
    $_SESSION['error'] = $session_error;
    header("Location: forgot.php");

} else {

    $allUsers = scandir("db/users");
    $countAllUsers = count($allUsers);

    for ($i = 0; $i < $countAllUsers; $i++) {

        $currentUserAvaileble = $allUsers[$i];

        if ($currentUserAvaileble == $email . ".json") { // check if email exist inDB

            
            $token = generate_token();   
           

            $subject = "Password Reset Link";
            $message = "A password request has be iniciated from your account, if you did not initiate this reset,please ignor this message, otherwise visit: localhost/snh-v1/reset.php?token=" . $token;
            $headers = "From: no-reply@sng.com" . "\r\n" .
                "CC: somebodyelse@example.com";
           

            file_put_contents("db/tokens/" . $email . ".json", json_encode(['token' => $token]));


            $try = mail($email, $subject, $message, $headers);
            // print_r($try);
            // die();

            if ($try) {
                // if message sent display success message

                $_SESSION['message'] = "Password Reset has been sent to your Mail: $email ";
                header("Location: login.php");

            } else {
                // if message not sent error message
                $_SESSION['error'] = "Something went wrong, we could not send reset code Mail: $email";

                header("Location: forgot.php");
            }

            die();
        }
    }
    // wrong email address
    $_SESSION['error'] = "Email not registered with us ERROR: $email ";
    header("Location: forgot.php");
}
