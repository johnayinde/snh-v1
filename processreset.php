<?php session_start();
require_once('functions/users.php');
require_once('functions/alert.php');
require_once('functions/redirect.php');;


$errorCount = 0;

if (!is_user_loggedIn()) {
    $token = $_POST['token'] != '' ? $_POST['token'] : $errorCount++;
    $_SESSION['token'] = $token;
  }


$email = $_POST['email'] != "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] != "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;

if ($errorCount > 0) {
    $session_error = "You have " . $errorCount . " Error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form";
    $_SESSION['error'] = $session_error;
    header("Location: reset.php");
    
} else {
    // if email is reg in token folder
    // if content of the register token in dir is same as $token

    $allUserTokens = scandir("db/tokens");
    $countAllUserTokens = count($allUserTokens);

    for ($i = 0; $i < $countAllUserTokens; $i++) {

        $currentTokenFile = $allUserTokens[$i];

        if ($currentTokenFile == $email . ".json") {
            // check if token is found in current user file

            $tokenJson = file_get_contents("db/tokens/" . $currentTokenFile);
            $tokenObj = json_decode($tokenJson);

            $tokenFromDb = $tokenObj->token;

            if ($_SESSION['loggedIn']) {
                $checkToken = true;
            } else {
                $checkToken = $tokenFromDb == $token;
            }

            if ($checkToken) {
                // do the password update to db

                $allUsers = scandir("db/users");
                $countAllUsers = count($allUsers);

                for ($i = 0; $i < $countAllUsers; $i++) {
                    $currentUser = $allUsers[$i];

                    if ($currentUser == $email . ".json") {
                        // check password

                        $userJson = file_get_contents("db/users/" . $currentUser);
                        $userObj = json_decode($userJson);

                        $userObj->password = password_hash($password, PASSWORD_DEFAULT);

                        unlink("db/users/" . $currentUser); // user data deleted

                        file_put_contents("db/users/" . $email . ".json", json_encode($userObj));
                        $_SESSION['message'] = "Password reset Successful, you can now login ";

                        /**
                         * Sending mail to user after changing password
                         */

                        $subject = "Password Reset Successful";
                        $message = "Your Account on SNH has just been updated ( password change )" . $token;
                        $headers = "From: no-reply@sng.com" . "\r\n" .
                            "CC: somebodyelse@example.com";

                        $try = mail($email, $subject, $message, $headers);

                        /**
                         * Sending mail to user after changing password
                         */

                        header("Location: login.php");

                        die();
                    }
                }
            }
        }
    }
    $_SESSION['error'] = "Password Reset Failed token/Email invalid/Expired ";
    header("Location: login.php");
}
