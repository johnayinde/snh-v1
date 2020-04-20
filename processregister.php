<?php
session_start();
require_once('functions/users.php');



$errorCount = 0;

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$designation = $_POST['designation'];
$department = $_POST['department'];

// != "" ? $_POST['department'] : $errorCount++;




/**
 * Form field validation start
 * 
 */
if (!preg_match("/^[a-zA-Z]*$/", $first_name) || (strlen($first_name) < 2)) {
    $_SESSION['error'] = "*Name must be more than two string and must contain only letters";
    $errorCount++;
} else {
    $first_name = test_input($_POST["first_name"]);
}


if (empty($_POST["email"])) {
    $_SESSION['error'] =  "*Email is required";

    $errorCount++;
} else {
    $email = test_input($_POST["email"]);
    if (!preg_match("/^[a-zA-Z0-9\.]*@[a-z\.]{1,}[a-z]*$/", $email) || $email == '') {
        $_SESSION['error'] =  "*Enter a valid email";
        $errorCount++;
    }
}



/**
 * Form field validation Ends
 * 
 */

/**
 * Session start
 */

$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['email'] = $email;
$_SESSION['gender'] = $gender;
$_SESSION['designation'] = $designation;
$_SESSION['department'] = $department;

/**
 * Session ends
 */

if ($errorCount > 0) {

    header("Location: register.php");
} else {

    $newId = ($countAllUsers - 1);


    // if user already exit using email :::: look into the user array if email a;ready exist..
    $userObj = [
        'id' => $newId,
        'first_name' => $first_name,
        'last_name' => $last,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'gender' => $gender,
        'designation' => $designation,
        'department' => $department,
        'lastLoginDate' => date("d/m/y h:i:s a"),
        'date' => date("d/m/y"),
    ];

    $UserExists = find_user($email);

    if ($UserExists) {
        $_SESSION['error'] = "Registration Failed,User Already exist";
        header("Location: register.php");
        die();
    }



    save_user($userObj);

    $_SESSION['message'] = "Registration Successful, you can now login ";
    header("Location: login.php");
}
