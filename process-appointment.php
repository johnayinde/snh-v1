<?php session_start();
require_once("./functions/users.php");
// require_once("./functions/redirect.php");



$errorCount = 0;

// Collect data, verify and validate.
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];
$appointment_nature = $_POST['appointment_nature'];
$initial_complaint = $_POST['initial_complaint'];
$appointment_department = $_POST['appointment_department'];


// Add sessions
$_SESSION['appointment_date'] = $appointment_date;
$_SESSION['appointment_time'] = $appointment_time;
$_SESSION['appointment_nature'] = $appointment_nature;
$_SESSION['initial_complaint'] = $initial_complaint;
$_SESSION['appointment_department'] = $appointment_department;



if ($errorCount > 0) {
	$session_error = "You have " . $errorCount . " Error";

    if ($errorCount > 1) {
        $session_error .= "s";
    }

    $session_error .= " in your form";
    set_alert('error', $session_error);


	redirect_to("book-appointment.php");
} else {
print_r($_SESSION);
	
	
	

	$appointObject = [
		'appointment_date' => $appointment_date,
		'full_name' => $_SESSION['fullname'],
		'gender' => $_SESSION['gender'],
		'email' => $_SESSION['email'],
		'appointment_time' => $appointment_time,
		'appointment_nature' => $appointment_nature,
		'initial_complaint' => $initial_complaint,
		'appointment_department' => $appointment_department,
	];



	add_appointment($appointObject);

	
	// unset($_SESSION['appointment_date'] );
	// unset($_SESSION['appointment_time']);
	// unset($_SESSION['appointment_nature']) ;
	// unset($_SESSION['initial_complaint'] );
	// unset($_SESSION['appointment_department']);

	$_SESSION["message"] = "Your appointment has been successfully booked";
	redirect_to("patient.php");
}
