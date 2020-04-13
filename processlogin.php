<?php
session_start();
require_once("functions/alert.php");


$errorCount = 0;
$email = $_POST['email'] !== "" ? $_POST['email'] : $errorCount++;
$password = $_POST['password'] !== "" ? $_POST['password'] : $errorCount++;

$_SESSION['email'] = $email;

if ($errorCount > 0) {
    $session_error = "You have " . $errorCount . " Error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form";
    set_alert('error', $session_error);

    header("Location: login.php");
} else {

    /**
     * admin login start
     */

    if ($email == 'admin@snh.com') {

        $adminJson = file_get_contents("db/admin/" . $email . ".json");
        $adminObj = json_decode($adminJson);
        $adminDbPassword = $adminObj->password;
        
        $adminPassword =  password_verify($password, $adminDbPassword);

        if ($adminPassword) {
            $_SESSION['loggedIn'] = $adminObj->id;
            $_SESSION['fullname'] = $adminObj->first_name . " " .  $adminObj->last_name;

            header("Location: admin-dashboard.php");

        }
    }
    /**
     * admin login ends
     */
    else {
        $allUsers = scandir("db/users");
        $countAllUsers = count($allUsers);

        for ($i = 0; $i < $countAllUsers; $i++) {
            $currentUser = $allUsers[$i];

            if ($currentUser == $email . ".json") {
                // check password
                $userJson = file_get_contents("db/users/" . $currentUser);
                $userObj = json_decode($userJson);
                $passwordFromDb = $userObj->password;
                $passwordFromUser =  password_verify($password, $passwordFromDb);


                if ($passwordFromDb == $passwordFromUser) {
                    $_SESSION['loggedIn'] = $userObj->id;
                    $_SESSION['email'] = $userObj->email;
                    $_SESSION['lastLogin'] = $userObj->lastLoginDate;
                    $_SESSION['date'] = $userObj->date;
                    $_SESSION['department'] = $userObj->department;
                    $_SESSION['fullname'] = $userObj->first_name . " " .  $userObj->last_name;
                    $_SESSION['role'] = $userObj->designation;

                    header("Location: dashboard.php");
                    die();
                }
            }
        }
        $_SESSION['error'] = "Invalid Email or Password";
        header("Location: login.php");
        die();
    }
}
