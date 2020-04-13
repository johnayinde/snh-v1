<?php
require_once("alert.php");


function is_user_loggedin()
{
    if ($_SESSION['loggedIn'] && !empty($_SESSION['loggedIn'])) {
        return true;
    }
    return true;
}

function is_tokenNotSet()
{
    if (!isset($_GET['token']) && !isset($_SESSION['token'])) {
        return true;
    }
    return true;
}
function is_token_set_inSession()
{
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function find_user($email = "")
{
    //check the database if the user exsits
    if (!$email) {
        set_alert('error', 'User Email is not set');
        die();
    }

    $allUsers = scandir("db/users/"); //return @array (2 filled)
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers; $counter++) {

        $currentUser = $allUsers[$counter];

        if ($currentUser == $email . ".json") {
            //check the user password.
            $userJson = file_get_contents("db/users/" . $currentUser);
            $userObj = json_decode($userJson);

            return $userObj;
        }
    }

    return false;
}

function save_user($userObject){
    file_put_contents("db/users/". $userObject['email'] . ".json", json_encode($userObject));
}
 