<?php
require_once("alert.php");


function is_user_loggedIn() {
    if(isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn']))  { 
      return true;
    }
    return false;
  }

  function is_token_set() {
    return is_token_set_in_get() || is_token_set_in_session();
  }


  function is_token_set_in_get() {
    return isset($_GET['token']);
 
  }

  function is_token_set_in_session() {
    return isset($_SESSION['token']);
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
    if (!$email) {
        set_alert('error', 'User Email is not set');
        die();
    }

    $allUsers = scandir("db/users/"); 
    $countAllUsers = count($allUsers);

    for ($counter = 0; $counter < $countAllUsers; $counter++) {

        $currentUser = $allUsers[$counter];
        if ($currentUser == $email . ".json") {
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

function redirect_to($url = ''){

  header("Location: " . $url);

}
 
function return_to($designation) {

  if ($designation == 'Patient') {
    redirect_to("patient.php");
    die();
  } else if ($designation == 'Medical Team (MT)') {
    redirect_to("medical-team.php");
    die();
  } else if ($designation == 'Super Admin (SA)') {
    redirect_to("super-admin.php");
    die();
  }
}

function add_appointment($appointObject){
  
  $allappointment = scandir('db/appointments/');
  $numOfappointments = count($allappointment);
  $Id = ($numOfappointments - 1);
  file_put_contents("db/appointments/". strtolower($appointObject['appointment_department']) . $Id . ".json", json_encode($appointObject));
}


function get_appointment($department) {
  $allAppointments = [];

  $appointmentsInDb = scandir("db/appointments");
  $countAllAppointments = count($appointmentsInDb) ;

  for ($counter = 2; $counter < $countAllAppointments; $counter++) {
    $currentAppointment = $appointmentsInDb[$counter];

    //if(strpos($currentAppointment, strtolower($department)) !== false) {
      $appointmentString = file_get_contents("db/appointments/".$currentAppointment);
      $appointmentObject = json_decode($appointmentString);
      array_push($allAppointments, $appointmentObject);
   // }
  }


  return $allAppointments;
}

function get_patients() {
  $allPatients = [];
  $allUsersInDb = scandir("db/users");
  $countAllUsers = count($allUsersInDb);

  for ($counter = 2; $counter < $countAllUsers; $counter++) {
    $currentUser = $allUsersInDb[$counter];
    $currentUserString = file_get_contents("db/users/".$currentUser);
    $currentUserObject = json_decode($currentUserString);
    $designation = $currentUserObject->designation;

    if ($designation == "Patient") {
      array_push($allPatients, $currentUserObject);
    }
  }
  return $allPatients;
}

function get_medical_staff() {
  $allMedicalStaff = [];
  $allUsersInDb = scandir("db/users");
  $countAllUsers = count($allUsersInDb);

  for ($counter = 2; $counter < $countAllUsers; $counter++) {
    $currentUser = $allUsersInDb[$counter];
    $currentUserString = file_get_contents("db/users/".$currentUser);
    $currentUserObject = json_decode($currentUserString);
    $designation = $currentUserObject -> designation;

    if ($designation == "Medical Team (MT)") {
      array_push($allMedicalStaff, $currentUserObject);
    }
  }
  return $allMedicalStaff;
}